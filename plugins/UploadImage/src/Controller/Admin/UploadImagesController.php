<?php
namespace UploadImage\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\Core\Configure; 
/**
 * UploadImages Controller
 *
 * @property \UploadImage\Model\Table\UploadImagesTable $UploadImages
 */
class UploadImagesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users','Casinos','City','City.Country','Country']
        ];
        $uploadImages = $this->paginate($this->UploadImages);

        $this->set(compact('uploadImages'));
        $this->set('_serialize', ['uploadImages']);
    }

    /**
     * View method
     *
     * @param string|null $id Upload Image id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $uploadImage = $this->UploadImages->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('uploadImage', $uploadImage);
        $this->set('_serialize', ['uploadImage']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $uploadImage = $this->UploadImages->newEntity();
        if ($this->request->is('post')) {
            $uploadImage = $this->UploadImages->patchEntity($uploadImage, $this->request->data);
            if ($this->UploadImages->save($uploadImage)) {
                $this->Flash->success(__('The upload image has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The upload image could not be saved. Please, try again.'));
            }
        }
        $users = $this->UploadImages->Users->find('list', ['limit' => 200]);
        $this->set(compact('uploadImage', 'users'));
        $this->set('_serialize', ['uploadImage']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Upload Image id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $uploadImage = $this->UploadImages->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $uploadImage = $this->UploadImages->patchEntity($uploadImage, $this->request->data);
            if ($this->UploadImages->save($uploadImage)) {
                $this->Flash->success(__('The upload image has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The upload image could not be saved. Please, try again.'));
            }
        }
        $users = $this->UploadImages->Users->find('list', ['limit' => 200]);
        $this->set(compact('uploadImage', 'users'));
        $this->set('_serialize', ['uploadImage']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Upload Image id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $uploadImage = $uploadImage1 = $this->UploadImages->get($id);
        if ($this->UploadImages->delete($uploadImage)) {
			@unlink(CASINO_THUMB_IMG_ROOT_PATH.$uploadImage1->image);
            $this->Flash->success(__('The upload image has been deleted.'));
        } else {
            $this->Flash->error(__('The upload image could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Upload Image id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function active($id = null)
    {
		if($id == null){
			return $this->redirect(['action' => 'index']);
		}		
        $uploadImage = $this->UploadImages->get($id);
		
		if(empty($uploadImage->id)){
			return $this->redirect(['action' => 'index']);
			exit;
		}
		
		if($uploadImage->type == 'casino'){
			$this->loadModel('Casinos');
			$res = $res1 = $this->Casinos->get($uploadImage->foreign_key);
			$object_id	=	$res->object_id;
			if(empty($res->object_id)){
				$res1->object_id 	=	$object_id = rand(1000000,9999999999);
				$this->Casinos->save($res1);
			}
			
			$this->loadModel('CasinoImages');
			$CasinoImages 				= 	$this->CasinoImages->newEntity();
			$CasinoImages->casino_id	=	$res->id;
			$CasinoImages->object_id	=	$object_id;
			$CasinoImages->user_id		=	$uploadImage->user_id;
			$CasinoImages->file			=	$uploadImage->image;
			$CasinoImages->image		=	1;
			$CasinoImages->filetype		=	1;
			$CasinoImages->type_id		=	1;
			$CasinoImages->title		=	$uploadImage->caption;
			$CasinoImages->description	=	$uploadImage->caption;
			$CasinoImages->display_order = 	1;
			$CasinoImages->type			= 	'casino';
			$this->CasinoImages->save($CasinoImages);
		}else if($uploadImage->type == 'city'){
			$this->loadModel('CityManager.City');
			$res = $res1 = $this->City->get($uploadImage->foreign_key);
			$object_id	=	$res->object_id;
			if(empty($res->object_id)){
				$res1->image 		=	$uploadImage->image;
				$res1->object_id 	=	$object_id = rand(1000000,9999999999);
				$this->City->save($res1);
			}
			$this->loadModel('CasinoImages');
			$CasinoImages 				= 	$this->CasinoImages->newEntity();
			$CasinoImages->casino_id	=	$res->id;
			$CasinoImages->object_id	=	$object_id;
			$CasinoImages->user_id		=	$uploadImage->user_id;
			$CasinoImages->file			=	$uploadImage->image;
			$CasinoImages->image		=	1;
			$CasinoImages->filetype		=	1;
			$CasinoImages->type_id		=	1;
			$CasinoImages->title		=	$uploadImage->caption;
			$CasinoImages->description	=	$uploadImage->caption;
			$CasinoImages->display_order = 	1;
			$CasinoImages->type			= 	'city';
			$this->CasinoImages->save($CasinoImages);
		}else if($uploadImage->type == 'country'){
			$this->loadModel('CityManager.Country');
			$res = $this->Country->get($uploadImage->foreign_key);
			$res = $res1 = $this->Country->get($uploadImage->foreign_key);
			$object_id	=	$res->object_id;
			if(empty($res->object_id)){
				$res1->image 		=	$uploadImage->image;
				$res1->object_id 	=	$object_id = rand(1000000,9999999999);
				$this->Country->save($res1);
			}
			
			
			$this->loadModel('CasinoImages');
			$CasinoImages 				= 	$this->CasinoImages->newEntity();
			$CasinoImages->casino_id	=	$res->id;
			$CasinoImages->object_id	=	$res->object_id;
			$CasinoImages->user_id		=	$uploadImage->user_id;
			$CasinoImages->file			=	$uploadImage->image;
			$CasinoImages->image		=	1;
			$CasinoImages->filetype		=	1;
			$CasinoImages->type_id		=	1;
			$CasinoImages->title		=	$uploadImage->caption;
			$CasinoImages->description	=	$uploadImage->caption;
			$CasinoImages->display_order = 	1;
			$CasinoImages->type			= 	'country';
			$this->CasinoImages->save($CasinoImages);
		}
		
		
		$this->loadModel('Users');
		
		$userDetails				=	$this->Users->find('all')->where(['id' => $uploadImage->user_id])->first();
		$totalPoints				=	isset($userDetails->user_points) ? $userDetails->user_points : 0;
		
		$userPoints		=	Configure::read('UserPoints.AddingPhoto');
		
		$reviewCount	=	$this->CasinoImages->find('all')->where(['object_id' => $object_id,'user_id IS NOT' => ADMIN_ID])->count();
		
		if($reviewCount == 1){
			$userPoints		=	Configure::read('UserPoints.AddingFirstPhoto')+$userPoints;
		}
		
		$userDetails->user_points	=	$totalPoints + $userPoints;		
		$this->Users->save($userDetails);
		
		
        if ($this->UploadImages->delete($uploadImage)) {
			@unlink(CASINO_THUMB_IMG_ROOT_PATH.$uploadImage1->image);
            $this->Flash->success(__('The upload image has been approved.'));
        } 
        return $this->redirect(['action' => 'index']);
    }
}
