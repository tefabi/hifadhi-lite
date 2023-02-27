#!/usr/bin/env groovy

pipeline {
    agent any

        stages {
            stage('build') {
                steps {
                    sh "cp .env.testing.jenkins .env.testing"
                    sh "composer install"
                }
            }
        stage('test') {
                steps {
                    sh "php artisan test"
                }
            }
        }
}
