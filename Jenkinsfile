node {
   def mvnHome

   stage ('Checkout'){
        checkout scm
   }

   stage('Composer Install') {
        sh './scripts/replace-parameters.sh'
        sh '/opt/plesk/php/7.0/bin/php composer selfupdate'
        sh '/opt/plesk/php/7.0/bin/php composer install'
   }

   stage('Prepare Test Database') {
        sh '/opt/plesk/php/7.0/bin/php bin/console do:da:dr --force --if-exists'
        sh '/opt/plesk/php/7.0/bin/php bin/console do:da:cr'
        sh '/opt/plesk/php/7.0/bin/php bin/console do:mi:mi -n'
        sh '/opt/plesk/php/7.0/bin/php bin/console do:fi:lo --fixtures src/AppBundle/DataFixtures/ORM/dev/ -n'
        sh '/opt/plesk/php/7.0/bin/php bin/console ca:c --env=test'
   }
}