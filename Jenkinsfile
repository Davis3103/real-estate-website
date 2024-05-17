pipeline {
    agent any

    stages {
        stage('Checkout') {
            steps {
                checkout scm
            }
        }

        stage('Build Docker Image') {
            steps {
                script {
                    dockerImage = docker.build("php-website:${env.BUILD_ID}", ".")
                }
            }
        }

        stage('Run Docker Container') {
            steps {
                script {
                    dockerContainer = dockerImage.run("-p 8080:80")
                }
            }
        }

        stage('Test Website') {
            steps {
                // Add your testing steps here, e.g., run PHP unit tests, perform functional tests, etc.
            }
        }

        stage('Deploy') {
            steps {
                // Add your deployment steps here, e.g., stop the previous container, remove the old image, and start a new container with the latest image
            }
        }
    }

    post {
        always {
            dockerContainer.stop()
        }
    }
}
