<?php
// use App\Models\User;

// $user = new User;
// $attributes = $user->getAttributes();

// // Да, вы можете определить метод getAllUserFields() и передавать в него экземпляр модели в качестве аргумента. Например:
// // php

// use Illuminate\Database\Eloquent\Model;

// function getAllUserFields(Model $user){
//     $attributes = $user->getAttributes();
//     return $attributes;
// }


// // Затем вы можете вызвать этот метод, передав экземпляр модели в качестве аргумента
// use App\Models\User;

// $user = User::find(1);
// $attributes = getAllUserFields($user);


// /* Код может находиться в любом месте вашего приложения, где вам нужно получить все атрибуты конкретного пользователя.

// Если вы хотите использовать этот код внутри метода контроллера, который обрабатывает запрос, то вы можете разместить этот код внутри этого метода. Например:
//  */
// use App\Models\User;

// public function getUserAttributes($id) {
//     $user = User::find($id);
//     $attributes = $this->getAllUserFields($user);
//     // делать что-то с атрибутами
// }

// private function getAllUserFields(User $user){
//     $attributes = $user->getAttributes();
//     return $attributes;
// }

// // Если вам нужно получить все записи из таблицы пользователей со всеми полями, то вы можете использовать статический метод all() модели User. Например:
// use App\Models\User;

// $users = User::all();

// // Вы также можете выбрать только нужные поля, используя метод select():
// $users = User::select('id', 'name', 'email')->get();

// // Вы можете использовать функцию gettype(), чтобы определить тип переменной. Например, вот как можно проверить, является ли переменная $result массивом или коллекцией:
// $result = SomeModel::someMethod();
// if (gettype($result) === 'array') {
//     // Это массив
// } elseif (gettype($result) === 'object' && $result instanceof Illuminate\Support\Collection) {
//     // Это коллекция
// }

// // Также можно использовать функцию is_array() и метод instanceof, чтобы проверить тип переменной. Вот как это можно сделать:
// $result = SomeModel::someMethod();
// if (is_array($result)) {
//     // Это массив
// } elseif ($result instanceof Illuminate\Support\Collection) {
//     // Это коллекция
// }
//  -->


// создаем экземпляр модели
// $model = new Model;

// // получаем поле id по полю name
// $id = $model->where('name', '=', $name)->firstOrFail()->id;

// // получаем id всех записей, у которых значение поля name равно $name
// $ids = Model::where('name', '=', $name)->pluck('id');
