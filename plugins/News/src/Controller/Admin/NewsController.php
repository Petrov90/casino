<?php
namespace News\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\I18n\I18n;
/**
 * News Controller
 *
 * @property \News\Model\Table\NewsTable $News
 */
class NewsController extends AppController
{

   public $components = ['Paginator'];
	
	/**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {	
		@unlink(CACHE.'cake_element__news_category_cache_callbacks');
		@unlink(CACHE.'cake_element__news_right_side_bar_cache_callbacks');
		@unlink(CACHE.'cake_element__news_right_side_bar_index_cache_callbacks');
		
		$this->loadModel('Languages');
		$lanagauageList	=	$this->Languages->find('all',['conditions' => ['is_Default' => 1]])->first();		
		
		I18n::locale($lanagauageList->code);		
		$query = $this->News->find();
		if(!empty($this->request->query)){
			$requestedQuery	=	$this->request->query;
			foreach($requestedQuery as $name => $value){
				if($name == 'page' || $name == 'language' || $name == 'sort' || $name == 'direction')
					continue;
				$query->where(['News_title_translation.content  LIKE' => '%'.$value.'%']);			
			}
			$this->set('requestedQuery',$requestedQuery);
		}
		
		$this->paginate = ['sortWhitelist' => ['title','description'],'contain' => ['Masters']];

		$query->order(['News.id' => 'desc']);
        $cmsPages = $this->paginate($query);
       
		$this->set(compact('cmsPages'));
        $this->set('_serialize', ['cmsPages']);
		$this->set('model',$this->modelClass);
    }

    

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$this->loadModel('Languages');
		$lanagauageList	=	$this->Languages->find('all',['conditions' => ['is_Default' => 1]])->first();
		
        $cmsPage = $this->News->newEntity();
        if ($this->request->is('post')) {
			$validateData				=	$this->request->data['_translations'][$lanagauageList->code];

			$validateData['slug']		=	isset($this->request->data['slug']) ? $this->request->data['slug'] : '';			
			$validateData['master_id']	=	isset($this->request->data['master_id']) ? $this->request->data['master_id'] : '';	
			$validateData['object_id']	=	isset($this->request->data['object_id']) ? $this->request->data['object_id'] : '';	
			$validateData['news_user']	=	isset($this->request->data['news_user']) ? $this->request->data['news_user'] : '';	
			$validateData['image_by']	=	isset($this->request->data['image_by']) ? $this->request->data['image_by'] : '';	
			$cmsPage = $this->News->patchEntity($cmsPage, $validateData);
			// pr($cmsPage);
			if(!$cmsPage->errors()){
				foreach ($this->request->data['_translations'] as $lang => $data) {
					if(empty($data['name'])){
						unset($data['name']);
					}
					if(empty($data['description'])){
						unset($data['description']);
					}
					$cmsPage->translation($lang)->set($data, ['guard' => false]);
				}
				
				$this->loadModel('CasinoImages');
				$object_id	=	$cmsPage->object_id;
				$image		=	$this->CasinoImages->find('all')->where(array('object_id' => $object_id))->order(['display_order' => 'ASC'])->first();
				$cmsPage->image	=	$image->file;
				
				$this->News->save($cmsPage);
				
				$this->Flash->success(__('The news has been saved.'));
				return $this->redirect(['action' => 'index']);
				
			}
			$this->Flash->error(__('The news could not be saved. Please, try again.'));
        }		
		$lanagauageList	=	$this->Languages->find('all',['conditions' => ['is_active' => 1]]);		
		$master_id		=	$this->News->Masters->find('list')->where(['type' => 'news_category','is_deleted' => 0]);
		$news_user		=	$this->News->Masters->find('list')->where(['type' => 'news_user','is_deleted' => 0]);
		$this->set(compact('cmsPage','lanagauageList','master_id','news_user'));
        $this->set('_serialize', ['cmsPage']);
		
		require_once('uploader/config.php');   //Config
		require_once('uploader/Uploader.php'); //Main php file
		
    }

    /**
     * Edit method
     *
     * @param string|null $id Cms Page id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$this->loadModel('Languages');
		$lanagauageList	=	$this->Languages->find('all',['conditions' => ['is_Default' => 1]])->first();
		
		$cmsPage = $this->News->find('translations')
			->where([
				'id' => $id
			])->first();
		if ($this->request->is(['patch', 'post', 'put'])) {
			
			$validateData['slug']		=	isset($this->request->data['slug']) ? $this->request->data['slug'] : '';			
			$validateData['master_id']	=	isset($this->request->data['master_id']) ? $this->request->data['master_id'] : '';	
			$validateData['object_id']	=	isset($this->request->data['object_id']) ? $this->request->data['object_id'] : '';	
			$validateData['news_user']	=	isset($this->request->data['news_user']) ? $this->request->data['news_user'] : '';
			$validateData['image_by']	=	isset($this->request->data['image_by']) ? $this->request->data['image_by'] : '';	
			$validateData['title']	=	isset($this->request->data['_translations']['en']['title']) ? $this->request->data['_translations']['en']['title'] : '';

			$cmsPage = $this->News->patchEntity($cmsPage, $validateData);
			
			
			if(!$cmsPage->errors()){
				foreach ($this->request->data['_translations'] as $lang => $data) {
					if(empty($data['name'])){
						unset($data['name']);
					}
					if(empty($data['description'])){
						unset($data['description']);
					}
					$cmsPage->translation($lang)->set($data, ['guard' => false]);
				}
				
				
				$this->loadModel('CasinoImages');
				$object_id	=	$cmsPage->object_id;
				$image		=	$this->CasinoImages->find('all')->where(array('object_id' => $object_id))->order(['display_order' => 'ASC'])->first();
				$cmsPage->image	=	$image->file;
				
				$this->News->save($cmsPage);
				$this->Flash->success(__('The news has been saved.'));
				return $this->redirect(['action' => 'index']);
				
			}
			$this->Flash->error(__('The news could not be saved. Please, try again.'));
        }
		$lanagauageList	=	$this->Languages->find('all',['conditions' => ['is_active' => 1]]);		
		$master_id		=	$this->News->Masters->find('list')->where(['type' => 'news_category','is_deleted' => 0]);
		$news_user		=	$this->News->Masters->find('list')->where(['type' => 'news_user','is_deleted' => 0]);
		$this->set(compact('cmsPage','lanagauageList','master_id','news_user'));
        $this->set('_serialize', ['cmsPage']);
		
		
		require_once('uploader/config.php');   //Config
		require_once('uploader/Uploader.php'); //Main php file
    }

    /**
     * Delete method
     *
     * @param string|null $id Cms Page id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $cmsPage = $this->News->get($id);
        if ($this->News->delete($cmsPage)) {
            $this->Flash->success(__('The news has been deleted.'));
        } else {
            $this->Flash->error(__('The news could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
	
    /**
     * Delete method
     *
     * @param string|null $id Cms Page id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function feat($id = null)
    {
       $this->News->updateAll(['is_feat' => 0],['is_feat' => 1]);
		
		
		$languages  =	 $this->News->find('all')->where(['id' => $id])->first();
		
		$languages->is_feat = 1;
		$this->News->save($languages);
		
		$this->Flash->success('Status changed successfully');
        return $this->redirect(['action' => 'index']);
    }
}
