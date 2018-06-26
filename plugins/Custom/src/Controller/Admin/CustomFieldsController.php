<?php
namespace Custom\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * CustomFields Controller
 *
 * @property \Custom\Model\Table\CustomFieldsTable $CustomFields
 */
class CustomFieldsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['CustomPages']
        ];
        $customFields = $this->paginate($this->CustomFields);

        $this->set(compact('customFields'));
        $this->set('_serialize', ['customFields']);
    }

    /**
     * View method
     *
     * @param string|null $id Custom Field id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $customField = $this->CustomFields->get($id, [
            'contain' => ['CustomPages']
        ]);

        $this->set('customField', $customField);
        $this->set('_serialize', ['customField']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $customField = $this->CustomFields->newEntity();
        if ($this->request->is('post')) {
            $customField = $this->CustomFields->patchEntity($customField, $this->request->data);
            if ($this->CustomFields->save($customField)) {
                $this->Flash->success(__('The custom field has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The custom field could not be saved. Please, try again.'));
            }
        }
        $customPages = $this->CustomFields->CustomPages->find('list', ['limit' => 200]);
        $this->set(compact('customField', 'customPages'));
        $this->set('_serialize', ['customField']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Custom Field id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $customField = $this->CustomFields->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $customField = $this->CustomFields->patchEntity($customField, $this->request->data);
            if ($this->CustomFields->save($customField)) {
                $this->Flash->success(__('The custom field has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The custom field could not be saved. Please, try again.'));
            }
        }
        $customPages = $this->CustomFields->CustomPages->find('list', ['limit' => 200]);
        $this->set(compact('customField', 'customPages'));
        $this->set('_serialize', ['customField']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Custom Field id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $customField = $this->CustomFields->get($id);
        if ($this->CustomFields->delete($customField)) {
            $this->Flash->success(__('The custom field has been deleted.'));
        } else {
            $this->Flash->error(__('The custom field could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
