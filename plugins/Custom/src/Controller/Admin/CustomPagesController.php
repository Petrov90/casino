<?php
namespace Custom\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * CustomPages Controller
 *
 * @property \Custom\Model\Table\CustomPagesTable $CustomPages
 */
class CustomPagesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $customPages = $this->paginate($this->CustomPages);

        $this->set(compact('customPages'));
        $this->set('_serialize', ['customPages']);
    }

    /**
     * View method
     *
     * @param string|null $id Custom Page id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($slug = null)
    {
        $customPage = $this->CustomPages->find('all')->contain(['CustomFields'])->where(['slug' => $slug])->first();
		
		if(!empty($this->request->data)){
			$data	=	$this->request->data;			
			foreach($data as $key1 => $value){
				if( is_array($value) && !empty($value['name'])){
					$file_name         				=     $value['name'];
					
					$ext = pathinfo($file_name, PATHINFO_EXTENSION);
					if(in_array($ext,Configure::read('allowed_image.extensions'))){
						$tmp_name          				=     $value['tmp_name'];
						$return_file_name   			=     $this->change_file_name($file_name);
						
						if($this->moveUploadedFile($tmp_name, SETTING_IMG_ROOT_PATH.$return_file_name)){
							$this->{$this->modelClass}->id	=	$key1;
							$this->{$this->modelClass}->saveField('value',SETTING_IMG_URL.$return_file_name);
						}
					}
				}else{
					$res 		= $this->Settings->find('all')->where(['id' => $key1])->first();
					
					$res->value = $value;
					$this->Settings->save($res);
				}
			}
			$this->Flash->success(__('Setting updated successfully.'));
		}
		
        $this->set('customPage', $customPage);
        $this->set('_serialize', ['customPage']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $customPage = $this->CustomPages->newEntity();
        if ($this->request->is('post')) {
            $customPage = $this->CustomPages->patchEntity($customPage, $this->request->data);
            if ($this->CustomPages->save($customPage)) {
                $this->Flash->success(__('The custom page has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The custom page could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('customPage'));
        $this->set('_serialize', ['customPage']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Custom Page id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $customPage = $this->CustomPages->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $customPage = $this->CustomPages->patchEntity($customPage, $this->request->data);
            if ($this->CustomPages->save($customPage)) {
                $this->Flash->success(__('The custom page has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The custom page could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('customPage'));
        $this->set('_serialize', ['customPage']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Custom Page id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $customPage = $this->CustomPages->get($id);
        if ($this->CustomPages->delete($customPage)) {
            $this->Flash->success(__('The custom page has been deleted.'));
        } else {
            $this->Flash->error(__('The custom page could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
