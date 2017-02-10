#!/usr/bin/env groovy

properties(
    [
        [
            $class: 'BuildDiscarderProperty',
            strategy: [$class: 'LogRotator', numToKeepStr: '10']
        ],
        pipelineTriggers([[$class: 'PeriodicFolderTrigger', interval: '12h']]),
    ]
)

node {
   def mvnHome

   stage ('Checkout'){
        checkout scm
   }

   stage('Composer Install') {
        withCredentials([
            [$class: 'StringBinding', credentialsId: 'DB_PASS', variable: 'DB_PASS'],
            [$class: 'StringBinding', credentialsId: 'SECRET', variable: 'SECRET'],
            [$class: 'StringBinding', credentialsId: 'SESSION', variable: 'SESSION']
        ]) {
            withEnv([
                'DB_HOST=127.0.0.1',
                'DB_PORT=null',
                'DB_NAME=jenkins_intentbackend',
                'DB_USER=jenkins',
                'LOCALE=de',
            ]) {
                sh './scripts/replace-parameters.sh'
            }
        }
        sh '/opt/plesk/php/7.1/bin/php composer selfupdate'
        sh '/opt/plesk/php/7.1/bin/php composer install'
   }
   parallel(
       stage('Code Analysis'){
            sh '/opt/plesk/php/7.1/bin/php vendor/bin/phpcs --standard=PSR1,PSR2 -s src;'
            sh '/opt/plesk/php/7.1/bin/php vendor/bin/phpcs --standard=PSR1,PSR2 -s tests;'
       }

       stage('Prepare Test Database') {
            sh '/opt/plesk/php/7.1/bin/php bin/console do:da:dr --force --if-exists'
            sh '/opt/plesk/php/7.1/bin/php bin/console do:da:cr'
            sh '/opt/plesk/php/7.1/bin/php bin/console do:mi:mi -n'
            sh '/opt/plesk/php/7.1/bin/php bin/console do:fi:lo --append --fixtures src/AppBundle/DataFixtures/ORM/dev/ -n'
            sh '/opt/plesk/php/7.1/bin/php bin/console ca:c --env=test'
       }
   )

   stage('Unit Tests with CodeCoverage') {
           sh '/opt/plesk/php/7.1/bin/php vendor/bin/phpunit --coverage-clover=coverage.xml'
   }

   stage('Clean-Up') {
        sh '/opt/plesk/php/7.1/bin/php bin/console do:da:dr --force --if-exists'
   }
}