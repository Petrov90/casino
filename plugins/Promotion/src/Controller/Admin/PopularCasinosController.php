<?php
namespace Promotion\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\I18n\I18n;

/**
 * PopularCasinos Controller
 *
 * @property \Promotion\Model\Table\PopularCasinosTable $PopularCasinos
 */
class PopularCasinosController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        
		
		$query = $this->PopularCasinos->find()->contain(['Casinos']);
		if(!empty($this->request->query)){
			$requestedQuery	=	$this->request->query;
			foreach($requestedQuery as $name => $value){
				if($name == 'page' || $name == 'language' || $name == 'sort' || $name == 'direction')
					continue;
				$query->where(["PopularCasinos.".$name.' LIKE' => '%'.$value.'%']);			
			}
			$this->set('requestedQuery',$requestedQuery);
		}
		
		$this->paginate = [
				// 'sortWhitelist' => ['title'],
				'limit' => 10,
				'order' => [
					'PopularCasinos.id' => 'desc'
				]];

        $Promotionss = $this->paginate($query);
		
		$model		=	$this->modelClass;
        $this->set(compact('Promotionss','model'));
        $this->set('_serialize', ['Promotionss']);
	
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$casino = $this->PopularCasinos->newEntity();
        if ($this->request->is('post')) {
			$casino 	= 	$this->PopularCasinos->patchEntity($casino, $this->request->data);
			if(!$casino->errors()){
				$textdomain	=	$casino->text1;
				if(!empty($textdomain)){
					$casino->text	=	json_encode($textdomain);
				}
				$thisData	=	$this->request->data;
				if(!empty($thisData['logo']['name'])){
					$file_name         						=     $thisData['logo']['name'];
					$tmp_name          						=     $thisData['logo']['tmp_name'];
					$return_file_name   					=     time().$this->change_file_name($file_name);				
					if($this->moveUploadedFile($tmp_name, PROMOTION_CASINO_LOGO_ROOT_PATH.$return_file_name)){
						$casino->logo						=		$return_file_name;
					}
				}
				
				$this->PopularCasinos->save($casino);
				
				// die;
				$this->Flash->success(__('The casino has been saved.'));
				return $this->redirect(['action' => 'index']);				
			}else{
				$this->Flash->error(__('The casino could not be saved. Please, try again.'));
			}
        }
		
		// $bonus_type	 =	 $this->PopularCasinos->Masters->find('list', ['conditions' => ['type' => 'bonus_type']]);
		
		$this->set(compact('casino','bonus_type'));
        $this->set('_serialize', ['casino']);
    }
	
	function getLnt($address){
		if(!empty($address)){
			$key 			= 	'';
			$url  			= 	"https://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($address)."&sensor=false&key=".$key;
			$result_string  = 	file_get_contents($url);
			$result 		= 	json_decode($result_string, true);
			
			$location		=	isset($result['results']['0']['geometry']['location']) ? $result['results']['0']['geometry']['location'] : '';
			return $location;
		}
	}

    /**
     * Edit method
     *
     * @param string|null $id Casino id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		
        $casino =	$res	= $this->PopularCasinos->get($id);
		// pr($casino);
		$res1	=	$res->logo;
        if ($this->request->is(['patch', 'post', 'put'])) {
            $casino 	= $this->PopularCasinos->patchEntity($casino, $this->request->data);
			
			if(!$casino->errors()){
				$textdomain	=	$casino->text1;
				if(!empty($textdomain)){
					$casino->text	=	json_encode($textdomain);
				}
				$thisData	=	$this->request->data;
				if(!empty($thisData['logo']['name'])){
					$file_name         						=     $thisData['logo']['name'];
					$tmp_name          						=     $thisData['logo']['tmp_name'];
					$return_file_name   					=     time().$this->change_file_name($file_name);				
					if($this->moveUploadedFile($tmp_name, PROMOTION_CASINO_LOGO_ROOT_PATH.$return_file_name)){
						$casino->logo						=		$return_file_name;
					}
				}else{
					$casino->logo	=	$res1;
				}
				
				$this->PopularCasinos->save($casino);				
				
				
				$this->Flash->success(__('The Casino has been updated.'));
				return $this->redirect(['action' => 'index']);
				
			}else{
				
				$this->Flash->error(__('The Casino could not be saved. Please, try again.'));
			}
        }
		
		// pr($promotion_bonus_types_array);
		$this->set(compact('casino','bonus_type','promotion_bonus_types_array'));
        $this->set('_serialize', ['casino']);
    }
	
    /**
     * Delete method
     *
     * @param string|null $id Casino id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $casino = $this->PopularCasinos->get($id);
		
        if ($this->PopularCasinos->delete($casino)) {
            $this->Flash->success(__('The casino has been deleted.'));
        } else {
            $this->Flash->error(__('The casino could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
	
	/**
     * Delete method
     *
     * @param string|null $id Casino id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function feat($id = null,$status)
    {
        $casino =	$res	= $this->PopularCasinos->get($id);
		 
		$casino->isfeat	=	$status;		
		$this->PopularCasinos->save($casino);		
		
		 $this->Flash->success(__('Status changes successfully.'));
        return $this->redirect(['action' => 'index']);
    }
	
	public function isMainPromotion($id = null)
    {
        $casino =	$res	= $this->PopularCasinos->get($id);
		
		$this->PopularCasinos->query()
			->update()
			->set(['is_main_promotion' => 0])
			->where(['casino_id' => $casino->casino_id])
			->execute();
				
		$casino->is_main_promotion	=	1;		
		$this->PopularCasinos->save($casino);		
		
		 $this->Flash->success(__('Status changes successfully.'));
        return $this->redirect(['action' => 'index']);
    }
	
	public function cityAutocomplete(){
		$this->loadModel('Casinos');
	
		$query 		= 	$this->request->query['q'];
		
		$results 	= 	$this->Casinos->find('all')->select(['title','url','id'])->where(['title LIKE' => '%'.$query.'%','type' => 'normal'])->limit(7);
		
		echo json_encode($results);
		exit;
	}	
}
