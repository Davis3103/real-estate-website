pipeline {
    agent any
    stages {
        stage('Checkout') {
            steps {
                checkout scm
            }
        }
        stage('Build') {
            steps {
                sh 'composer install'
                sh 'npm install'
                sh 'npm run build'
            }
        }
        stage('Deploy') {
          steps {
            sh 'docker stop realestateapp-container || true'
            sh 'docker rm realestateapp-container || true'
            sh 'docker build -t realestateapp-image .'
            sh 'docker run -d --name realestateapp-container -p 8080:80 realestateapp-image'
                }
         }
        }
        stage('UI Automation') {
            steps {
                sh 'vendor/bin/phpunit --testsuite UITests'
            }
        }
    }
}
