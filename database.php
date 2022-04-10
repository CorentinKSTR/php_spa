<?php

class Database
{
    private PDO $connection;

    public function __construct()
    {
        $this->connection = new PDO('mysql:host=127.0.0.1;dbname=php-oo', 'root', '');
    }

    public function createUser(User $user): void
    {
        $query = $this->connection->prepare('
            INSERT INTO `user` (`email`, `first_name`, `last_name`, `password`)
            VALUES (:email, :first_name, :last_name, :password)
        ');

        $query->execute([
            'email' => $user->email,
            'first_name' => $user->firstName,
            'last_name' => $user->lastName,
            'password' => password_hash($user->password, PASSWORD_ARGON2I),
        ]);
    }

    public function getUsers(): array
    {
        $users = [];

        $query = $this->connection->query('SELECT * FROM `user`');

        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $user = new User($row['email'], $row['password'], $row['first_name'], $row['last_name']);
            $users[] = $user;
        }

        return $users;
    }

    public function login ($email, $password): bool
    {

        $query = $this->connection->prepare('SELECT * FROM `user` WHERE email = :email');

        $query->execute([
            'email' => $email,
        ]);

        $user_data = $query->fetch();

        if($user_data){
            $check_password = password_verify($password, $user_data['password']);

            if($check_password){
                $_SESSION['email'] = $user_data['email'];
                $_SESSION['first_name'] = $user_data['first_name'];
                $_SESSION['roles'] = $user_data['roles'];
                $_SESSION['id'] = $user_data['id'];

                header('location:user.php');

                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }

    }

    public function pet_category(): array
    {
        $query = $this->connection->query('SELECT * FROM `category`');

        $categories = $query->fetchAll();
        return $categories;
    }

    public function add_pet(Pet $pet): void
    {
        $query = $this->connection->prepare('
            INSERT INTO `pet` (`name`, `category_id`, `user_id`)
            VALUES (:name, :category_id, :user_id)
        ');

        $query->execute([
            'name' => $pet->name,
            'category_id' => $pet->type,
            'user_id' => $pet->user,
        ]);
    }

    public function your_pet (): array
    {

        $query = $this->connection->prepare('SELECT pet.id as id, pet.name as `name`, category.type as `type` FROM pet INNER JOIN category ON pet.category_id = category.id WHERE user_id = :user_id');

        $query->execute([
            'user_id' => $_SESSION['id'],
        ]);

        $pet_list = $query->fetchAll();
        return $pet_list;

        

    }

    public function delete($id): void
    {

        $query = $this->connection->prepare('DELETE FROM pet WHERE id = :id');

        $query->execute([
            'id' => $id,
        ]);

    }

    public function all_user (): array
    {

        $query = $this->connection->query('SELECT `user`.first_name as name, COUNT(pet.user_id) as quantity, user.email as email FROM `user` 
                                            LEFT JOIN pet ON `user`.id = pet.user_id
                                            GROUP by `user`.id');

        $user_list = $query->fetchAll();
        return $user_list;


    }

    public function users_pets ($email): array
    {

        $query = $this->connection->prepare('SELECT user.email as email, pet.name as `name`, category.type as `type` FROM pet 
                                            INNER JOIN category ON pet.category_id = category.id 
                                            INNER JOIN `user` ON pet.user_id = `user`.id
                                            WHERE email = :email
                                            ');

        $query->execute([
            'email' => $email,
        ]);

        $users_pet_list = $query->fetchAll();
        return $users_pet_list;


    }

}