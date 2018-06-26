<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\Core\Configure;
use Cake\Cache\Cache;

/**
 * ReviewSpams Controller
 *
 * @property \App\Model\Table\ReviewSpamsTable $ReviewSpams
 */
class ReviewSpamsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
		$query = $this->ReviewSpams->find();
		if(!empty($this->request->query)){
			$requestedQuery	=	$this->request->query;
			foreach($requestedQuery as $name => $value){
				if($name == 'page' || $name == 'language' || $name == 'sort' || $name == 'direction')
					continue;
				$query->where(["Users.".$name.' LIKE' => '%'.$value.'%']);			
		
			}
			$this->set('requestedQuery',$requestedQuery);
		}
		
		$this->paginate = [
				'sortWhitelist' => ['address', 'title','phone','country_name','state_name','id'],
				'limit' => Configure::read('Reading.record_per_page'),
				'sort' => 'id',
				'direction' => 'desc',
				'contain' => [
					'Users',
					'Reviews','Reviews.City','Reviews.City.CCountry','Reviews.Casinos','Reviews.Country','Reviews.Users',
					'Master',
					'ReviewComments','ReviewComments.Users',
					'ReviewComments.Reviews',
					'ReviewComments.Reviews.Casinos',
					'ReviewComments.Reviews.City',
					'ReviewComments.Reviews.Country',
					'ReviewComments.Reviews.City.CCountry'
				]
			];
		
        $reviewSpams = $this->paginate($query);

        $this->set(compact('reviewSpams'));
        $this->set('_serialize', ['reviewSpams']);
    }

    /**
     * View method
     *
     * @param string|null $id Review Spam id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $reviewSpam = $this->ReviewSpams->get($id, [
            'contain' => ['Users', 'Reviews']
        ]);

        $this->set('reviewSpam', $reviewSpam);
        $this->set('_serialize', ['reviewSpam']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $reviewSpam = $this->ReviewSpams->newEntity();
        if ($this->request->is('post')) {
            $reviewSpam = $this->ReviewSpams->patchEntity($reviewSpam, $this->request->data);
            if ($this->ReviewSpams->save($reviewSpam)) {
                $this->Flash->success(__('The review spam has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The review spam could not be saved. Please, try again.'));
            }
        }
        $users = $this->ReviewSpams->Users->find('list', ['limit' => 200]);
        $reviews = $this->ReviewSpams->Reviews->find('list', ['limit' => 200]);
        $this->set(compact('reviewSpam', 'users', 'reviews'));
        $this->set('_serialize', ['reviewSpam']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Review Spam id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $reviewSpam = $this->ReviewSpams->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $reviewSpam = $this->ReviewSpams->patchEntity($reviewSpam, $this->request->data);
            if ($this->ReviewSpams->save($reviewSpam)) {
                $this->Flash->success(__('The review spam has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The review spam could not be saved. Please, try again.'));
            }
        }
        $users = $this->ReviewSpams->Users->find('list', ['limit' => 200]);
        $reviews = $this->ReviewSpams->Reviews->find('list', ['limit' => 200]);
        $this->set(compact('reviewSpam', 'users', 'reviews'));
        $this->set('_serialize', ['reviewSpam']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Review Spam id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $reviewSpam = $this->ReviewSpams->get($id);
        if ($this->ReviewSpams->delete($reviewSpam)) {
			
			$this->loadModel('Reviews');
			$review		=	$this->Reviews->find('all')->where(['id' => $reviewSpam->review_id])->first();	
			
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
        } else {
            $this->Flash->error(__('The review could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
	
	/**
     * Delete method
     *
     * @param string|null $id Review Spam id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function deletespam($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $reviewSpam = $this->ReviewSpams->get($id);
        if ($this->ReviewSpams->delete($reviewSpam)) {
			
            $this->Flash->success(__('The spam request has been deleted.'));
        } else {
            $this->Flash->error(__('The spam request could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
