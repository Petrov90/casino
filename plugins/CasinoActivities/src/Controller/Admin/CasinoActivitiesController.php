<?php
namespace CasinoActivities\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\I18n\I18n;
use Cake\Cache\Cache;

/**
 * CasinoActivities Controller
 *
 * @property \CasinoActivities\Model\Table\CasinoActivitiesTable $CasinoActivities
 */
class CasinoActivitiesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
       $this->loadModel('Languages');
		$lanagauageList	=	$this->Languages->find('all',['conditions' => ['is_Default' => 1]])->first();		
		$this->paginate = [
            'order' => ['CmsPages.id DESC']
        ];
		I18n::locale($lanagauageList->code);		
		$query = $this->CasinoActivities->find();
		if(!empty($this->request->query)){
			$requestedQuery	=	$this->request->query;
			foreach($requestedQuery as $name => $value){
				if($name == 'page' || $name == 'language' || $name == 'sort' || $name == 'direction')
					continue;
				$query->where(['CasinoActivities.title LIKE' => '%'.$value.'%']);			
			}
			$this->set('requestedQuery',$requestedQuery);
		}
		
		$this->paginate = ['sortWhitelist' => ['title','description'],'contain' => 'ParentMasters'];

		$query->where(['CasinoActivities.is_deleted' => 0]);			

        $cmsPages = $this->paginate($query);
       
		$this->set(compact('cmsPages'));
        $this->set('_serialize', ['cmsPages']);
		$this->set('model',$this->modelClass);
    }

    /**
     * View method
     *
     * @param string|null $id Casino Activity id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $casinoActivity = $this->CasinoActivities->get($id, [
            'contain' => ['CasinoActivitityDatas']
        ]);

        $this->set('casinoActivity', $casinoActivity);
        $this->set('_serialize', ['casinoActivity']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        
		$casino 		= 	$this->CasinoActivities->newEntity();
		$masterCasino	=	$this->request->data;
        if ($this->request->is('post')) {
        	//echo "<pre>"; print_r($this->request->data); die;
			$this->CasinoActivities->type = $this->request->data['parent_id'];
            $casino 	= 	$this->CasinoActivities->patchEntity($casino, $this->request->data);
			if(!$casino->errors()){			
				$casino->info	=		!empty($this->request->data['info']) ? serialize($this->request->data['info']) : '';
				$casino->schedule	=	!empty($this->request->data['schedule']) ? serialize($this->request->data['schedule']) : '';
				$this->CasinoActivities->save($casino);
				$casino_id	=	$casino->id;
				
				$this->loadModel('CasinoActivityDatas');
				
				$ActivityDatas 	= 	$this->CasinoActivityDatas->newEntity();
				//$ActivityDatas->id		= 	$CasinoActivityDatas->id;
				$ActivityDatas->casino_id	=	$this->request->data['casino_id'];
				$ActivityDatas->casino_activity_id	= $casino_id;
				$ActivityDatas->parent_id	=	$this->request->data['parent_id'];
				//echo "<pre>"; print_r($ActivityDatas); die;
				$this->CasinoActivityDatas->save($ActivityDatas);

				$this->Flash->success(__('The aminities has been saved.'));
				return $this->redirect(['action' => 'index']);
			}else{
				
				$this->Flash->error(__('The aminities could not be saved. Please, try again.'));
			}
        }
        $this->loadModel('Casinos');
		$totalCasinolist = $this->Casinos->find('list')->where(['type' => 'normal']);
		$parentMasters = $this->CasinoActivities->ParentMasters->find('list')->where(['parent_id' => 0,'is_deleted' => 0]);
		$amenitiesInfo = $this->CasinoActivities->ActivityInfo->find('list')->where(['type' => 'amenities_info','is_deleted' => 0]);
		// pr($amenitiesInfo);
		
		require_once('uploader/config.php');   //Config
		require_once('uploader/Uploader.php'); //Main php file

		$this->set(compact('casino','amenities','gambling_options','country','software','deposit_methods','currencies','language','withdrawal_methods','withdrawal_limit','owner','manual_flushing','live_chat','licences','devices','parentMasters','amenitiesInfo','totalCasinolist'));
		
		$this->set('model',$this->modelClass);
    }
    public function cityAutocomplete(){
		$this->loadModel('Casinos');
	
		$query 		= 	$this->request->query['q'];
		
		$results 	= 	$this->Casinos->find('all')->select(['title','url','id'])->where(['title LIKE' => '%'.$query.'%','type' => 'normal'])->limit(7);
		
		echo json_encode($results);
		exit;
	}	
    /**
     * Edit method
     *
     * @param string|null $id Casino Activity id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $casino = $this->CasinoActivities->get($id, [
            'contain' => []
        ]);
        //echo $casino->id;
        $this->loadModel('CasinoActivityDatas');
        $CasinoActivityDatas	=	$this->CasinoActivityDatas->find('all',['conditions' => ['casino_activity_id' => $casino->id]])->first();	
        //echo "<pre>"; print_r($CasinoActivityDatas); die;
        if (!empty($this->request->data)) {
            $casino 	= 	$this->CasinoActivities->patchEntity($casino, $this->request->data);
			/* pr($casino->errors()); */
			if(!$casino->errors()){
				$casino->info	=	serialize($this->request->data['info']);
				$casino->schedule	=	serialize($this->request->data['schedule']);
				//echo "<pre>"; print_r($this->request->data); //die; 
				$this->CasinoActivities->save($casino);
				$casino_id	=	$casino->id;
				//echo $casino_id; die;
				$this->CasinoActivityDatas->deleteAll(['id' => $CasinoActivityDatas->id]);
				$ActivityDatas 	= 	$this->CasinoActivityDatas->newEntity();
				//$ActivityDatas->id		= 	$CasinoActivityDatas->id;
				$ActivityDatas->casino_id	=	$this->request->data['casino_id'];
				$ActivityDatas->casino_activity_id	= $casino_id;
				$ActivityDatas->parent_id	=	$this->request->data['parent_id'];
				//echo "<pre>"; print_r($ActivityDatas); die;
				$this->CasinoActivityDatas->save($ActivityDatas);

				$this->Flash->success(__('The aminities has been saved.'));
				return $this->redirect(['action' => 'index']);
			}else{
				
				$this->Flash->error(__('The aminities could not be saved. Please, try again.'));
			}
        }
		$this->loadModel('Casinos');
		$totalCasinolist = $this->Casinos->find('list')->where(['type' => 'normal']);
		$parentMasters = $this->CasinoActivities->ParentMasters->find('list')->where(['parent_id' => 0,'is_deleted' => 0]);
		$amenitiesInfo = $this->CasinoActivities->ActivityInfo->find('list')->where(['type' => 'amenities_info','is_deleted' => 0]);
		require_once('uploader/config.php');   //Config
		require_once('uploader/Uploader.php'); //Main php file
		// pr($casino);
		// pr(unserialize($casino->schedule));amenitiesInfo
		$this->request->data['info']		= 	unserialize($casino->info);
		$this->request->data['schedule']	= 	unserialize($casino->schedule);
		// pr(	json_decode($casino->schedule));
		$this->set(compact('casino','amenities','gambling_options','country','software','deposit_methods','currencies','language','withdrawal_methods','withdrawal_limit','owner','manual_flushing','live_chat','licences','devices','parentMasters','amenitiesInfo','totalCasinolist'));
		
		$this->set('model',$this->modelClass);
    }

    /**
     * Delete method
     *
     * @param string|null $id Casino Activity id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        // $this->request->allowMethod(['post', 'delete']);
		$master = $this->CasinoActivities->get($id);
		
		$master->is_deleted	=	1;
		if($master->parent_id == 0){
			$this->CasinoActivities->query()
				 ->update()
				->set(['is_deleted' => 1])
				->where(['parent_id' => $id])
				->execute();
		}
        if ($this->CasinoActivities->save($master)) {
            $this->Flash->success(__('The aminities has been deleted.'));
        } else {
            $this->Flash->error(__('The aminities could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
