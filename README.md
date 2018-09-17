# Move-city

## Installation

Cloner le dépôt : 

```bash
$ git clone https://github.com/TuxBoy/0--site-integrale.git Move-city && cd Move-city
```

* Une fois dans le dossier du projet, configurer la base de données dans le .env : 

```
...
DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name
...
```
Remplacer les variables suivantes :
* **db_user** : User de Mysql.
* **db_password** : le mot de passe de votre user mysql.
* **db_name** : le nom de la base de données créé en amond.

Quand la configuration à la base de données est correctement configurer, il faut lancer les migrations (ça va créé les différentes tables/champs qu'il faut)

```bash
$ php bin\console doctrine:migrations:migrate
```

Quand la migration a bien fini, il faut maintenant (et c'est pas obligatoire) pre-remplir la table de fausse données, ça permet d'avoir des données de base pour tester

```bash
$ php bin/console doctrine:fixtures:load
```

Ensuite, il suffit de lancer le serveur web interne à PHP (là c'est pareil c'est un choix, avec un apache ça fonctionne aussi)

```bash
$ php bin/console server:run
```

Avec cette procédure ça devrait le faire :)
