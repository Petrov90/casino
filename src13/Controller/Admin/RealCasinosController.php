<?php
namespace App\Controller\Admin;


use App\Controller\Admin\AppController;

/**
 * RealCasinos Controller
 *
 * @property \App\Model\Table\RealCasinosTable $RealCasinos
 */
class RealCasinosController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
		
		$query = $this->RealCasinos->find();
		if(!empty($this->request->query)){
			$requestedQuery	=	$this->request->query;
			foreach($requestedQuery as $name => $value){
				if($name == 'page' || $name == 'language' || $name == 'sort' || $name == 'direction')
					continue;
				$query->where([$name.' LIKE' => '%'.$value.'%']);			
				
			}
			$this->set('requestedQuery',$requestedQuery);
		}
		$this->paginate = ['sortWhitelist' => ['address', 'title','phone','country_name','state_name']];
		
		$query->where(['is_saved' => '0']);			
		
        $realCasinos = $this->paginate($query);
		
		$model		=  $this->modelClass;	
        $this->set(compact('realCasinos','model'));
        $this->set('_serialize', ['realCasinos']);
    }

    /**
     * View method
     *
     * @param string|null $id Real Casino id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $realCasino = $this->RealCasinos->get($id, [
            'contain' => []
        ]);

        $this->set('realCasino', $realCasino);
        $this->set('_serialize', ['realCasino']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
   /*  public function add()
    {
        $realCasino = $this->RealCasinos->newEntity();
        if ($this->request->is('post')) {
			$casino = $this->Casinos->newEntity();

			$casino 	= 	$this->Casinos->patchEntity($casino, $this->request->data);
			
			if(!$casino->errors()){
				$this->loadModel('CasinoImages');
				$object_id	=	$casino->object_id;
				$image		=	$this->CasinoImages->find('all')->where(array('object_id' => $object_id))->order(['display_order' => 'ASC'])->first();
				$casino->image	=	$image->file;
				$casino->type	=	'normal';
				
				$address		=	$casino->address.' '.$casino->city.' '.$casino->country_id;
				
				$zip				=	$this->getLnt($address);
				$casino->latitude	=	(isset($zip['lat']) ? $zip['lat'] : '');
				$casino->longitude	=	(isset($zip['lng']) ? $zip['lng'] : '');
				
				
				$this->Casinos->save($casino);
				$casino_id	=	$casino->id;
				$amenities	=	$casino->amenities;
			
				if(!empty($amenities)){
					foreach($amenities as $pkey => $val){
						if(is_array($val)){
							foreach($val as $key => $val){
								if($val){										
									$casinoAmenities 	= 	$this->Casinos->CasinoAmenities->newEntity();
									$casinoAmenities->casino_id	=	$casino_id;
									$casinoAmenities->master_id	=	$key;
									$casinoAmenities->parent_id	=	$pkey;
									$this->Casinos->CasinoAmenities->save($casinoAmenities);
								}
							}
						}
					}
				}				
				$gambling_options	=	$casino->gambling_options;
				if(!empty($gambling_options)){
					foreach($gambling_options as $key => $val){
						if($val && $key > 0){
							$CasinoGamblingOptions 				= 	$this->Casinos->CasinoGamblingOptions->newEntity();
							$CasinoGamblingOptions->casino_id	=	$casino_id;
							$CasinoGamblingOptions->master_id	=	$key;
							$this->Casinos->CasinoGamblingOptions->save($CasinoGamblingOptions);
						}
					}
				}
				
				$this->Flash->success(__('The casino has been saved.'));
				return $this->redirect(['action' => 'index']);
				
			}else{
				
				$this->Flash->error(__('The casino could not be saved. Please, try again.'));
			}
        }
        $this->set(compact('realCasino'));
        $this->set('_serialize', ['realCasino']);
    } */

    /**
     * Edit method
     *
     * @param string|null $id Real Casino id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $realCasino = $this->RealCasinos->get($id, [
            'contain' => []
        ]);
		$this->loadModel('Casinos');
		
		$casino = $this->Casinos->newEntity();
		$this->set('error',false);
        if ($this->request->is(['patch', 'post', 'put'])) {
			$casino 	= 	$this->Casinos->patchEntity($casino, $this->request->data);			
			if(!$casino->errors()){
				$this->loadModel('CasinoImages');
				$object_id	=	$casino->object_id;
				$image		=	$this->CasinoImages->find('all')->where(array('object_id' => $object_id))->order(['display_order' => 'ASC'])->first();
				$casino->image	=	$image->file;
				$casino->type	=	'normal';
				
				$address			=	$casino->address.' '.$casino->city_name.' '.$casino->country_name;
				
				$zip				=	$this->getLnt($address);
				$casino->latitude	=	(isset($zip['lat']) ? $zip['lat'] : '');
				$casino->longitude	=	(isset($zip['lng']) ? $zip['lng'] : '');
				
				if(!empty($this->request->data['country_id'])){
					$this->loadModel('CityManager.Country');
					$continentId	=	$this->Country->find('all')->where(['id' => $this->request->data['country_id']])->first();
					$casino->continent_id	=	$continentId->continent_id;
				}
				
				// $casino->avg_rating		=	$casino->our_rating;
				
				$this->Casinos->save($casino);
				$casino_id	=	$casino->id;
				$amenities	=	$casino->amenities;
			
				if(!empty($amenities)){
					foreach($amenities as $pkey => $val){
						if(is_array($val)){
							foreach($val as $key => $val){
								if($val){										
									$casinoAmenities 	= 	$this->Casinos->CasinoAmenities->newEntity();
									$casinoAmenities->casino_id	=	$casino_id;
									$casinoAmenities->master_id	=	$key;
									$casinoAmenities->parent_id	=	$pkey;
									$this->Casinos->CasinoAmenities->save($casinoAmenities);
								}
							}
						}
					}
				}				
				$gambling_options	=	$casino->gambling_options;
				if(!empty($gambling_options)){
					foreach($gambling_options as $key => $val){
						if($val && $key > 0){
							$CasinoGamblingOptions 				= 	$this->Casinos->CasinoGamblingOptions->newEntity();
							$CasinoGamblingOptions->casino_id	=	$casino_id;
							$CasinoGamblingOptions->master_id	=	$key;
							$this->Casinos->CasinoGamblingOptions->save($CasinoGamblingOptions);
						}
					}
				}
				
				$this->Flash->success(__('The casino has been moved to real casino.'));
				
				$realCasino->is_saved	=	1;
				
				$this->RealCasinos->save($realCasino);
				
				return $this->redirect(['action' => 'index']);
				
			}else{
				
				$this->Flash->error(__('The casino could not be saved. Please, try again.'));
				$this->set('error',true);
			}
        }
		
		$gambling_options	 =	 $this->Casinos->Masters->find('list', ['conditions' => ['type' => 'gambling_options','is_deleted' => 0]]);
		
		$country			 =	 $this->Casinos->Country->find('list')->order(['name' => 'ASC']);
		
		$amenities			 =	 $this->Casinos->Masters->find('all', ['contain' => ['ChildMasters'],'conditions' => ['type' => 'aminities','parent_id' => 0,'is_deleted' => 0]]);
		
		require_once('uploader/config.php');   //Config
		require_once('uploader/Uploader.php'); //Main php file
		
		$this->set(compact('casino','realCasino','amenities','gambling_options','country','casino_amenities','casino_gambling_options'));
        $this->set('_serialize', ['realCasino']);
		// pr($realCasino);
    }

    /**
     * Delete method
     *
     * @param string|null $id Real Casino id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $realCasino = $this->RealCasinos->get($id);
        if ($this->RealCasinos->delete($realCasino)) {
            $this->Flash->success(__('The real casino has been deleted.'));
        } else {
            $this->Flash->error(__('The real casino could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
