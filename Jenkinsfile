pipeline {
    agent any

    environment {
        DOCKER_COMPOSE = '/usr/local/bin/docker-compose' // Path to docker-compose
    }

    stages {
        stage('Checkout') {
            steps {
                git 'https://github.com/Davis3103/real-estate-website.git' // Replace with your repository URL
            }
        }

        stage('Build and Run Containers') {
            steps {
                script {
                    sh "${DOCKER_COMPOSE} down"
                    sh "${DOCKER_COMPOSE} up -d --build"
                }
            }
        }

        stage('Cleanup') {
            steps {
                script {
                    sh "${DOCKER_COMPOSE} down"
                }
            }
        }
    }

    post {
        always {
            cleanWs()
        }
    }
}
