<?php
    namespace App\Repositories;
    
    use Illuminate\Support\Facades\Log;
    use App\Repositories\RepositoryInterface;

    abstract class BaseRepository implements RepositoryInterface 
    {
        /**
        * @var \Illuminate\Database\Eloquent\Model
        */
        protected $model;

        public function __construct()
        {
            $this->setModel();
        }

        abstract public function getModel();

        /**
         * Set model
         */
        public function setModel()
        {
            return $this->model = app()->make(
                $this->getModel()
            );
        }

        public function getAll()
        {
            return $this->model->all();
        }

        public function find($id) 
        {
            try {
                $data =  $this->model->findOrFail($id);

                return $data;
            } catch (\Exception $e) {
                return 'General error: '.$e->getMessage();
            }
        }
        
        public function create(array $attrs)
        {
            try {
                $data = $this->model->create($attrs);
                
                return $data;
            } catch (\Exception $e) {
                return 'General error: '.$e->getMessage();
            }          
        }

        public function update($id,array $attrs)
        {
            try {
                $data = $this->find($id);
                if($data) {
                    $data->update($attrs);
                    $data->save();
    
                    return $data;
                }
            } catch (\Exception $e) {
                return 'General error: '.$e->getMessage();
            }
        }

        public function delete($id) 
        {
            try {
                $data = $this->find($id);
                if($data) {
                    $data->delete();
    
                    return true;
                }
            } catch (\Exception $e) {
                 return 'General error: '.$e->getMessage();
            }
        }

    }
?>