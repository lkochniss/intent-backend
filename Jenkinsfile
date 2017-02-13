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
   def php = '/opt/plesk/php/7.1/bin/php'
   def database = "jenkins_${env.JOB_NAME}_${env.BRANCH_NAME}"

   stage ('Checkout'){
        checkout scm
   }

   stage('Composer Install') {
        parallel setupParameters: {
            withCredentials([
                [$class: 'StringBinding', credentialsId: 'DB_PASS', variable: 'DB_PASS'],
                [$class: 'StringBinding', credentialsId: 'SECRET', variable: 'SECRET'],
                [$class: 'StringBinding', credentialsId: 'SESSION', variable: 'SESSION']
            ]) {
                withEnv([
                    "DB_HOST=127.0.0.1",
                    "DB_PORT=null",
                    "DB_NAME=${database}",
                    "DB_USER=jenkins",
                    "LOCALE=de",
                ]) {
                    sh './scripts/replace-parameters.sh'
                }
            }
        }, composerSelfupdate: {
            sh "${php} composer selfupdate"
        },
        failFast: false
        sh "${php} composer install"
   }

   stage('Code Analysis'){
        parallel srcAnalysis: {
            sh "${php} vendor/bin/phpcs --standard=PSR1,PSR2 -s src;"
        }, testAnalysis: {
            sh "${php} vendor/bin/phpcs --standard=PSR1,PSR2 -s tests;"
        },
        failFast: true
   }

   stage('Prepare Test Database') {
        sh "${php} bin/console do:da:dr --force --if-exists"
        sh "${php} bin/console do:da:cr"
        sh "${php} bin/console do:sc:up --force"
        sh "${php} bin/console do:fi:lo --append --fixtures src/AppBundle/DataFixtures/ORM/dev/ -n"
        sh "${php} bin/console ca:c --env=test"
   }

   stage('Unit Tests') {
        parallel articleTests: {
            sh "${php} vendor/bin/phpunit --group=article"
        }, categoryTests: {
            sh "${php} vendor/bin/phpunit --group=category"
        },  eventTests: {
            sh "${php} vendor/bin/phpunit --group=event"
        }, expansionTests: {
            sh "${php} vendor/bin/phpunit --group=expansion"
        }, franchiseTests: {
            sh "${php} vendor/bin/phpunit --group=franchise"
        }, gameTests: {
            sh "${php} vendor/bin/phpunit --group=game"
        }, imageTests: {
            sh "${php} vendor/bin/phpunit --group=image"
        }, pageTests: {
            sh "${php} vendor/bin/phpunit --group=page"
        }, profileTests: {
            sh "${php} vendor/bin/phpunit --group=profile"
        }, publisherTests: {
            sh "${php} vendor/bin/phpunit --group=publisher"
        }, studioTests: {
            sh "${php} vendor/bin/phpunit --group=studio"
        }, tagTests: {
            sh "${php} vendor/bin/phpunit --group=tag"
        }, userTests: {
            sh "${php} vendor/bin/phpunit --group=user"
        }, otherTests: {
            sh "${php} vendor/bin/phpunit --group=other"
        }
        failFast: false
   }

   stage('Clean Up') {
        sh "${php} bin/console do:da:dr --force --if-exists"
  }
}
