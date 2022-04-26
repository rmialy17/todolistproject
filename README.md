# todolistproject

## Comment contribuer ?

* Pour commencer à contribuer, suivez [le guide de contribution](CONTRIBUTING.md).

___
## Comment installer le projet ?

```
git clone https://github.com/rmialy17/todolistproject.git
cd todolistproject
composer install
symfony serve -d
```

Vous devrez configurer un accès à une database locale ou distante dans un fichier .env à la racine du projet (voir format du .env).
Vous pouvez ensuite créer la database et lancer les fixtures avec les commande :

```
symfony console doctrine:database:create
symfony console doctrine:migrations:migrate
symfony console doctrine:fixtures:load
```

___

### - Lancer les tests

Pour voir si les tests fonctionnent :
- Rajouter xdebug à votre configuration php si vous ne l'avez pas : https://xdebug.org/
- Créer une base de donnée de test : ```php bin/console doctrine:database:create --env=test```
- Mettre à jour le schéma de la base de donnée de test : ```php bin/console doctrine:schema:update --env=test --force```
- Charger les fixtures dans la base de donnée de test : ```php bin/console doctrine:fixtures:load --env=test```
- Lancer les tests : ```php bin/phpunit``` ou ```./vendor/bin/phpunit```
- Pour voir le test-coverage (dans le dossier web/test-coverage) : ```./vendor/bin/phpunit --coverage-html web/test-coverage```

### Profiling
- Si vous souhaitez tester les performances de l'application, installez et utilisez Blackfire : https://blackfire.io/docs/up-and-running/installation

___

### - Lien [Codacy](https://app.codacy.com/gh/rmialy17/todolistproject/dashboard)
