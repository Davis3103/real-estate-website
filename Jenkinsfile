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
                sh 'docker stop your-app-container || true'
                sh 'docker rm your-app-container || true'
                sh 'docker build -t your-app-image .'
                sh 'docker run -d --name your-app-container -p 8080:80 your-app-image'
            }
        }
        stage('UI Automation') {
            steps {
                sh 'vendor/bin/phpunit --testsuite UITests'
            }
        }
    }
}
