# Symfony-Security

This is a Symfony app with security including authentication and authorization with user roles.

For use the app, we have to load data fixtures before authentication. The next table contains the informations about each user:

|Email|Password|Surname|Firstname|Roles|
|---|---|---|---|---|
|steve.rogers@avengers.com|CAPTAIN$0n7ourL3fT$AMERICA|Rogers|Steve|ROLE_USER|
|tony.stark@avengers.com|IRON$1loveU3000$MAN|Stark|Tony|ROLE_USER, ROLE_ADMIN, ROLE_SUPER_ADMIN|
|bruce.banner@avengers.com|THE$1amAlway5Angry$HULK|Banner|Bruce|ROLE_USER, ROLE_ADMIN|
|thor.odinson@avengers.com|THOR$Br1ngMEthanos!$KING|Odinson|Thor|ROLE_USER|
|natasha.romanoff@avengers.com|BLACK$L3tmegoIts0K$WIDOW|Romanoff|Natasha|ROLE_USER, ROLE_ADMIN|
|clint.barton@avengers.com|HAWK$D0ntGIVEm3h0pe$EYE|Barton|Clint|ROLE_USER|
|peter.parker@avengers.com|SPIDER$Fr1endlyN3ighborh00d$MAN|Parker|Peter|ROLE_USER, ROLE_ADMIN, ROLE_SUPER_ADMIN|
|stephen.strange@avengers.com|DOCTOR$Were1Nth3endgameNOW$STRANGE|Strange|Stephen|ROLE_USER|

### Routes

We have 5 routes in the project and each user can access a route according to his roles:
|Routes|Roles|Description|
|---|---|---|
|/||Login page|
|/profile|ROLE_USER|User informations without roles|
|/users|ROLE_USER, ROLE_ADMIN|All users informations with roles only for ROLE_SUPER_ADMIN|
|/users/edit/{id}|ROLE_USER, ROLE_ADMIN, ROLE_SUPER_ADMIN|Edit user informations|
|/logout||Sign out the app|

- Access control for the Security of the project
```yaml
# config/packages/security.yaml
# ...
    access_control:
            # - { path: ^/admin, roles: ROLE_ADMIN }
            # - { path: ^/profile, roles: ROLE_USER }
            - { path: ^/profile, roles: ROLE_USER }
            - { path: ^/users/edit/, roles: ROLE_SUPER_ADMIN }
            - { path: ^/users, roles: ROLE_ADMIN }
# ...
```

        
        
        

### Install the project

Get the dependencies and follow instructions:

1. Create database in MySQL
```bash
symfony console doctrine:database:create
```

2. Execute migration
```bash
symfony console doctrine:migrations:migrate
```

3. Load data fixtures
```bash
symfony console doctrine:fixtures:load
```

4. Run the app
```bash
symfony server:start
```

5. Choose a user for authentication and test the app