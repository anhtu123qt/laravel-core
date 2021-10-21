<?php


    namespace App\Repositories;
    
    use Illuminate\Support\Facades\Log;
    use App\Repositories\RepositoryInterface;
    use Illuminate\Support\Facades\DB;

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
            DB::beginTransaction();
            try {
                $data =  $this->model->findOrFail($id);
                DB::commit();

                return $data;
            } catch (\Exception $e) {
                return 'General error: '.$e->getMessage();
                DB::rollback();
            }
        }
        
        public function create(array $attrs)
        {
            DB::beginTransaction();
            try {
                $data = $this->model->create($attrs);
                DB::commit();
                return $data;
            } catch (\Exception $e) {
                return 'General error: '.$e->getMessage();
                DB::rollback();
            }   
               
        }

        public function update($id,array $attrs)
        {
            DB::beginTransaction();        
            try {
                $data = $this->find($id);
                if($data) {
                    $data->update($attrs);
                    $data->save();
                    DB::commit();
                    return $data;
                }
            } catch (\Exception $e) {
                return 'General error: '.$e->getMessage();
                DB::rollback();
            }
        }

        public function delete($id) 
        {
            DB::beginTransaction();
            try {
                $data = $this->find($id);
                if($data) {
                    $data->delete();
                    DB::commit();
                }
            } catch (\Exception $e) {
                 return 'General error: '.$e->getMessage();
                 DB::rollback();
            }
        }

    }
?>