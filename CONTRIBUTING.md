CONTRIBUTING.md

# Comment contribuer 

Pour contribuer à ce projet, suivez les étapes ci-dessous.

Prérequis :  Avant de suivre ces étapes, vous devez installer git et composer sur votre machine locale et créer un compte Github.
Vous trouverez ci-dessous un lien vers la documentation Symfony afin de vous guider sur les bonnes pratiques lors des modifications que vous apporterez au projet :

https://symfony.com/doc/current/best_practices.html

## Création d'un fork local du projet
Cliquez sur le bouton "fork" en haut à droite de la page. Cela créera une copie de ce repository dans votre propre Github. 


## Créer une copie locale Clonez votre copie de GitHub sur votre machine locale :
```
git clone https://github.com/VotreNomdutilisateurGithub/todolistproject
```

Et installez le projet et ses dépendances en vous référant à README.md


## Créer une nouvelle branche
Accédez au répertoire du repository sur votre ordinateur.
Créez la nouvelle branche en utilisant un nom logique correspondant aux changements ou nouveautés :

```
git checkout -b new-feature
```

## Ajouter de nouveaux tests liés aux modifications
Pour implémenter de nouveaux tests, reportez-vous à la documentation officielle de Symfony.
Exécutez les tests avec génération d'un rapport de couverture de code pour vous assurer que tout le nouveau code est en cours d'exécution :

```
vendor/bin/phpunit --coverage-html testcoverage
```

## Valider les modifications

Faites les commits se référant à vos modifications . Veillez à rédiger un message clair explicitant les changements (example : « Update readme file ». 
Voici les commandes à effectuer successivement afin de valider et soumettre vos modifications. 
``` 
git add.
git commit -m 'commit message' 
```

Submit the changes to your forke repository
```
git push origin new-feature
```
## Créer une pull request
Accédez à votre repository créé grâce au fork : votre nouvelle branche est à présent répertoriée en haut avec un bouton pratique "Compare & pull request". Cliquez sur ce bouton.
Dans la champ dédié, rédigez un titre concis afin et d'expliquer le but de cette pull request.

Vous devez maintenant soumettre la pull-request au repository d'origine. Pour ce faire, appuyez sur le bouton "Créer une pull-request" et vous avez terminé.
Le propriétaire du projet recevra alors une notification indiquant qu’une personne suggère une modification.
## Changements
Si vous êtes invité à ajouter ou à modifier quoi que ce soit, ne créez pas de nouvelle demande de paiement. Assurez-vous que vous êtes sur la bonne branche et effectuez les modifications.
```
git checkout new-feature
```