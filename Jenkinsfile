pipeline {
    agent any

    environment {
        DOCKER_COMPOSE = '/usr/local/bin/docker-compose' // Path to docker-compose
    }

    stages {
        stage('Checkout') {
            steps {
                git branch: 'main', url: 'https://github.com/Davis3103/real-estate-website.git' // Replace with your branch name if different
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

        stage('Run Tests') {
            steps {
                script {
                    // Example command to run PHPUnit tests
                    sh 'docker exec php-web vendor/bin/phpunit'
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
