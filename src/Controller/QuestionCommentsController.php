<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * QuestionComments Controller
 *
 * @property \App\Model\Table\QuestionCommentsTable $QuestionComments
 */
class QuestionCommentsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Questions', 'Users']
        ];
        $questionComments = $this->paginate($this->QuestionComments);

        $this->set(compact('questionComments'));
        $this->set('_serialize', ['questionComments']);
    }

    /**
     * View method
     *
     * @param string|null $id Question Comment id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $questionComment = $this->QuestionComments->get($id, [
            'contain' => ['Questions', 'Users']
        ]);

        $this->set('questionComment', $questionComment);
        $this->set('_serialize', ['questionComment']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $questionComment = $this->QuestionComments->newEntity();
        if ($this->request->is('post')) {
            $questionComment = $this->QuestionComments->patchEntity($questionComment, $this->request->data);
            if ($this->QuestionComments->save($questionComment)) {
                $this->Flash->success(__('The question comment has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The question comment could not be saved. Please, try again.'));
            }
        }
        $questions = $this->QuestionComments->Questions->find('list', ['limit' => 200]);
        $users = $this->QuestionComments->Users->find('list', ['limit' => 200]);
        $this->set(compact('questionComment', 'questions', 'users'));
        $this->set('_serialize', ['questionComment']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Question Comment id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $questionComment = $this->QuestionComments->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $questionComment = $this->QuestionComments->patchEntity($questionComment, $this->request->data);
            if ($this->QuestionComments->save($questionComment)) {
                $this->Flash->success(__('The question comment has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The question comment could not be saved. Please, try again.'));
            }
        }
        $questions = $this->QuestionComments->Questions->find('list', ['limit' => 200]);
        $users = $this->QuestionComments->Users->find('list', ['limit' => 200]);
        $this->set(compact('questionComment', 'questions', 'users'));
        $this->set('_serialize', ['questionComment']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Question Comment id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $questionComment = $this->QuestionComments->get($id);
        if ($this->QuestionComments->delete($questionComment)) {
            $this->Flash->success(__('The question comment has been deleted.'));
        } else {
            $this->Flash->error(__('The question comment could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
