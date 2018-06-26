<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\Core\Configure;
use Cake\Cache\Cache;
/**
 * Reviews Controller
 *
 * @property \App\Model\Table\ReviewsTable $Reviews
 */
class ReviewsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
		$query = $this->Reviews->find();
		if(!empty($this->request->query)){
			$requestedQuery	=	$this->request->query;
			foreach($requestedQuery as $name => $value){
				if($name == 'page' || $name == 'language' || $name == 'sort' || $name == 'direction')
					continue;
				if($name == 'full_name')
					$query->where(["Users.".$name.' LIKE' => '%'.$value.'%']);			
				else
					$query->where([$name.' LIKE' => '%'.$value.'%']);			
					
			}
			$this->set('requestedQuery',$requestedQuery);
		}
		
		$this->paginate = [
				'sortWhitelist' => ['address', 'title','phone','country_name','state_name','id'],
				'limit' => Configure::read('Reading.record_per_page'),
				'sort' => 'id',
				'direction' => 'desc',
				'contain' => ['Users', 'City', 'Country', 'Casinos']
			];
		
        $reviews = $this->paginate($query);

        $this->set(compact('reviews'));
        $this->set('_serialize', ['reviews']);
		
    }

    /**
     * View method
     *
     * @param string|null $id Review id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $review = $this->Reviews->get($id, [
            'contain' => ['Users', 'City', 'Country', 'Casinos', 'ReviewLikes', 'ReviewComments']
        ]);

        $this->set('review', $review);
        $this->set('_serialize', ['review']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $review = $this->Reviews->newEntity();
        if ($this->request->is('post')) {
            $review = $this->Reviews->patchEntity($review, $this->request->data);
            if ($this->Reviews->save($review)) {
                $this->Flash->success(__('The review has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The review could not be saved. Please, try again.'));
            }
        }
        $users = $this->Reviews->Users->find('list', ['limit' => 200]);
        $city = $this->Reviews->City->find('list', ['limit' => 200]);
        $country = $this->Reviews->Country->find('list', ['limit' => 200]);
        $casinos = $this->Reviews->Casinos->find('list', ['limit' => 200]);
        $this->set(compact('review', 'users', 'city', 'country', 'casinos'));
        $this->set('_serialize', ['review']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Review id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $review = $this->Reviews->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $review = $this->Reviews->patchEntity($review, $this->request->data);
            if ($this->Reviews->save($review)) {
                $this->Flash->success(__('The review has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The review could not be saved. Please, try again.'));
            }
        }
        $users = $this->Reviews->Users->find('list', ['limit' => 200]);
        $city = $this->Reviews->City->find('list', ['limit' => 200]);
        $country = $this->Reviews->Country->find('list', ['limit' => 200]);
        $casinos = $this->Reviews->Casinos->find('list', ['limit' => 200]);
        $this->set(compact('review', 'users', 'city', 'country', 'casinos'));
        $this->set('_serialize', ['review']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Review id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
		$review		=	$this->Reviews->find('all')->where(['id' => $id])->first();	
		
		$type	=	$review->type;
		$this->Reviews->delete($review);			
		
		Cache::delete('reviewList','longlong');
		
		if($type == 'casino'){
			$this->loadModel('Casinos');
			$res	=	$this->Reviews->find('all')->where(['type' => $type,'foreign_key' => $review->foreign_key]);
			
			$count	=	$res->count();
			$sum	=	$res->sumOf('rating');
			$avg	=	0;
			if($count > 0)
				$avg	=	$sum/$count;
			
			$UpdateData	 = $this->Casinos->find('all')
			->where([
				'Casinos.id' => $review->foreign_key
			])->first();
			
			if($UpdateData->type == 'online'){
				if($avg > 0){
					$avg_rating					=	($avg + $UpdateData->our_rating)/2;
				}else{
					$avg_rating					=	$UpdateData->our_rating;						
				}
				$UpdateData->review_count	=	$count;
				$UpdateData->member_rating	=	$avg;
				$UpdateData->avg_rating		=	$avg_rating;
				$this->Casinos->save($UpdateData);					
			}else{					
				$UpdateData->review_count	=	$count;
				$UpdateData->member_rating	=	$avg;
				$UpdateData->avg_rating		=	$avg;
				$this->Casinos->save($UpdateData);
			}
			
			Cache::delete('promotions','longlong');
		}else if($type == 'city'){
			$this->loadModel('CityManager.City');
			$res	=	$this->Reviews->find('all')->where(['type' => $type,'foreign_key' => $review->foreign_key]);
			
			$count	=	$res->count();
			$sum	=	$res->sumOf('rating');
			$avg	=	0;
			if($count > 0){
				$avg	=	$sum/$count;					
			}
			
			$UpdateData	 = $this->City->find('all')
			->where([
				'City.id' => $review->foreign_key
			])->first();
			$UpdateData->review_count	=	$count;
			$UpdateData->avg_rating		=	$avg;
			$this->City->save($UpdateData);
		
		}else if($type == 'news'){
			$this->loadModel('News');
			$res	=	$this->Reviews->find('all')->where(['type' => $type,'foreign_key' => $review->foreign_key]);
			
			$count	=	$res->count();
			$sum	=	$res->sumOf('rating');
			$avg	=	0;
			if($count > 0){
				$avg	=	$sum/$count;					
			}
			
			$UpdateData	 = $this->News->find('all')
			->where([
				'News.id' => $review->foreign_key
			])->first();
			$UpdateData->review_count	=	$count;
			$UpdateData->avg_rating		=	$avg;
			$this->News->save($UpdateData);
			
		}else{
			$this->loadModel('CityManager.Country');
			$res	=	$this->Reviews->find('all')->where(['type' => $type,'foreign_key' => $review->foreign_key]);
			$count	=	$res->count();
			$sum	=	$res->sumOf('rating');
			$avg	=	0;
			if($count > 0){
				$avg	=	$sum/$count;					
			}
			
			$UpdateData	 = $this->Country->find('all')
			->where([
				'Country.id' => $review->foreign_key
			])->first();
			$UpdateData->review_count	=	$count;
			$UpdateData->avg_rating		=	$avg;
			$this->Country->save($UpdateData);
			
		}
		
		$this->Flash->success(__('The review has been deleted.'));
       

        return $this->redirect(['action' => 'index']);
    }
}
