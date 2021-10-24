<?php
    namespace App\Repositories;

    interface RepositoryInterface {
        /**
         * Get all
         *
         * @return mixed
         */
        public function getAll();

        /**
         * Get one
         * @return mixed
         */
        public function getOne($id);

        /**
         * Create
         * @param array $attrs
         * @return mixed
         */
        public function create(array $attrs);

         /**
         * Update
         * @param $id
         * @param array $attrs
         * @return mixed
         */
        public function update($id,array $attrs);

        /**
         * Delete
         * @param $id
         * @return mixed
         */
        public function delete($id);
    }
?>

