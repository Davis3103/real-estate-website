pipeline {
    agent any
    stages {
        stage('Clone repository') {
            steps {
                git 'https://github.com/Davis3103/real-estate-website.git'
            }
        }
        stage('Build') {
            steps {
                script {
                    docker-compose -f docker-compose.yml build
                }
            }
        }
        stage('Test') {
            steps {
                script {
                    docker-compose -f docker-compose.yml up --abort-on-container-exit
                }
            }
        }
        stage('Deploy') {
            steps {
                script {
                    docker-compose -f docker-compose.yml up -d
                }
            }
        }
    }
}
