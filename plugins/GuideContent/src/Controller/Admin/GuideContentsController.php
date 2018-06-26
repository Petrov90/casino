<?php
namespace GuideContent\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\Utility\Inflector;
use Cake\Event\Event;
use Cake\I18n\I18n;
use Cake\Core\Configure;
// use GuideContent\Controller\Admin\AppController;

/**
 * GuideContents Controller
 *
 * @property \GuideContent\Model\Table\GuideContentsTable $GuideContents
 */
class GuideContentsController extends AppController
{
    //Configure::write('debug', 2);
    public $components = ['Paginator'];
    
    public $paginate = [
        'limit' => 10,
        'order' => [
            'GuideContents.id' => 'desc'
        ]
    ];
    
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->set('model',$this->modelClass);
		Configure::write('debug', 2);
    }
    /**
     * Index method
     * @param string|null $type GuideContent type.
     * @return \Cake\Network\Response|null
     */
    public function index($type = null)
    {
		$this->clearCache();
        if(empty($type)){
            die('Error');
        }
        
        $this->loadModel('Languages');
        $lanagauageList =   $this->Languages->find('all',['conditions' => ['is_Default' => 1]])->first();       
        I18n::locale($lanagauageList->code);    
        
        $this->paginate = [
            'order' => ['GuideContents.id DESC'],
            'sortWhitelist' => ['name']
        ];

        $heading    =   Inflector::humanize($type);
        
        $query = $this->GuideContents->find();        
        $query->where(['GuideContents.type' => $type]);   
        
        if(!empty($this->request->query)){
            $requestedQuery =   $this->request->query;
            foreach($requestedQuery as $name => $value){
                if($name == 'page' || $name == 'language' || $name == 'sort' || $name == 'direction')
                    continue;
                $query->where(['GuideContents.'.$name.' LIKE' => '%'.$value.'%']);            
            }
            $this->set('requestedQuery',$requestedQuery);
        }
        
        $query->where(['GuideContents.is_deleted' => 0]);
        
        // $this->paginate = [];

        $GuideContents = $this->paginate($query);
       
        
        // pr($GuideContents);
        $this->set(compact('GuideContents','type','heading'));
		
		
        $this->set('_serialize', ['GuideContents']);
    }

    

    /**
     * Add method
     * @param string|null $type GuideContent type.
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add($type = null)
    {
        if(empty($type)){
            die('Error');
        }
        $this->loadModel('Languages');
            
        $heading    =   Inflector::humanize($type);
        $GuideContent     =   $this->GuideContents->newEntity();
        if ($this->request->is('post')) { 
            //echo "<pre>"; print_r($this->request->data); die;
			$this->GuideContents->type = $type;
            
            $defaultLang    =   $this->Languages->find('all',['conditions' => ['is_Default' => 1]])->first();
        
            $validateData   =   $this->request->data['_translations'][$defaultLang->code];
            $validateData['image']  =   $this->request->data['image'];  
            $validateData['image2']  =   $this->request->data['image2'];  
			
			$GuideContent         =   $this->GuideContents->patchEntity($GuideContent, $validateData);       
			
            if(!$GuideContent->errors()){           
				$thisData 			  =   $this->request->data;
				if(!empty($thisData['image']['name'])){
					$file_name                              =     $thisData['image']['name'];
					$tmp_name                               =     $thisData['image']['tmp_name'];
					$return_file_name                       =     time().$this->change_file_name($file_name);               
					if($this->moveUploadedFile($tmp_name, GALLERY_ROOT_PATH.$return_file_name)){
						$GuideContent->image                      =       $return_file_name;					   
					}
				}
				if(!empty($thisData['image2']['name'])){
					$file_name                              =     $thisData['image2']['name'];
					$tmp_name                               =     $thisData['image2']['tmp_name'];
					$return_file_name                       =     time().$this->change_file_name($file_name);               
					if($this->moveUploadedFile($tmp_name, GALLERY_ROOT_PATH.$return_file_name)){
						$GuideContent->image2                      =       $return_file_name;					   
					}
				}
				foreach ($this->request->data['_translations'] as $lang => $data) {
                    $GuideContent->translation($lang)->set($data, ['guard' => false]);
                }
                $GuideContent->type       =   $type;
				$GuideContent->image_alt = $this->request->data['_translations']['en']['image_alt'];
					
                $this->GuideContents->save($GuideContent);
			
              $this->Flash->success($heading.' has been saved.');
              return $this->redirect(['action' => 'index',$type]);
                
            }else {
                $this->Flash->error(__($heading.' could not be saved. Please, try again.')); 
            }
        }
		
        $lanagauageList =   $this->Languages->find('all',['conditions' => ['is_active' => 1]]);
		
        $this->set(compact('GuideContent','type','heading','lanagauageList'));
		
        $this->set('_serialize', ['GuideContent']);
    }

    /**
     * Edit method
     *
     * @param string|null $id GuideContent id.
     * @param string|null $type GuideContent type.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null,$type = null)
    {
        $GuideContent =   $result = $this->GuideContents->find('translations')
            ->where([
                'id' => $id
            ])->first();
        $this->loadModel('Languages');
        $heading    =   Inflector::humanize($type);
		$return_file_name1	=	$GuideContent->image;
		$return_file_name2	=	$GuideContent->imag2;
        if ($this->request->is(['patch', 'post', 'put'])) {
            $orimage        =   $result->image;
            $defaultLang    =   $this->Languages->find('all',['conditions' => ['is_Default' => 1]])->first();
        
            $validateData               =   $this->request->data['_translations'][$defaultLang->code];
            if(in_array($type,Configure::read('image_array'))){
                $validateData['image']  =   $this->request->data['image'];
                $validateData['image2']  =   $this->request->data['image2'];
            }
			$GuideContent         =   $this->GuideContents->patchEntity($GuideContent, $validateData); 
			
            if(!$GuideContent->errors()){

				$thisData   =   $this->request->data;
				if(!empty($thisData['image']['name'])){
					$file_name                              =     $thisData['image']['name'];
					$tmp_name                               =     $thisData['image']['tmp_name'];
					$return_file_name                       =     time().$this->change_file_name($file_name);               
					if($this->moveUploadedFile($tmp_name, GALLERY_ROOT_PATH.$return_file_name)){
						$GuideContent->image                      =       $return_file_name;
					   
					}
				}else{
					$GuideContent->image                      =       $return_file_name1;
				}
				if(!empty($thisData['image2']['name'])){ sleep(1);
					$file_name                              =     $thisData['image2']['name'];
					$tmp_name                               =     $thisData['image2']['tmp_name'];
					$return_file_name                       =     time().$this->change_file_name($file_name);               
					if($this->moveUploadedFile($tmp_name, GALLERY_ROOT_PATH.$return_file_name)){
						$GuideContent->image2                      =       $return_file_name;
					   
					}
				}else{
					$GuideContent->image2                      =       $return_file_name2;
				}
				
				foreach ($this->request->data['_translations'] as $lang => $data) {
                    $GuideContent->translation($lang)->set($data, ['guard' => false]);
                }

                $GuideContent->type       =   $type;
                $this->GuideContents->save($GuideContent);
                $this->Flash->success($heading.' has been saved.');
                return $this->redirect(['action' => 'index',$type]);
                
            }else {
                $this->Flash->error(__($heading.' could not be saved. Please, try again.')); 
            }
        }
        
        $lanagauageList =   $this->Languages->find('all',['conditions' => ['is_active' => 1]]);
        $this->set(compact('GuideContent','type','heading','lanagauageList'));
        $this->set('_serialize', ['GuideContent']);
    }

    /**
     * Delete method
     *
     * @param string|null $id GuideContent id.
     * @param string|null $type GuideContent type.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null,$type = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $GuideContent = $this->GuideContents->get($id);       
        $GuideContent->is_deleted =   1;
        if ($this->GuideContents->save($GuideContent)) {
            $this->Flash->success(__('The '.$type.' has been deleted.'));
        } else {
            $this->Flash->error(__('The '.$type.' could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index',$type]);
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
        $casino =	$res	= $this->GuideContents->get($id);
		 
		$casino->isfeat	=	$status;		
		$this->GuideContents->save($casino);		
		
		 $this->Flash->success(__('Status changes successfully.'));
        return $this->redirect(['action' => 'index','guide']);
    }
}