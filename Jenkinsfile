pipeline {
    agent any

    stages {
        stage('Checkout SCM') {
            steps {
                checkout scm
            }
        }

        stage('Build Docker Images') {
            steps {
                echo 'Building Docker image for PHP application...'
                bat 'docker build -t "php-web" -f Dockerfile .'
            }
        }

        stage('Deploy Containers') {
            steps {
                echo 'Stopping any existing containers...'
                script {
                    def stopContainer = bat(script: 'docker stop php-web || exit 0', returnStatus: true)
                    if (stopContainer != 0) {
                        echo "Container php-web was not running or could not be stopped."
                    }
                }
                echo 'Starting new container...'
                bat 'docker run -d --name php-web -p 82:80 php-web'
            }
        }

        stage('Wait for Services') {
            steps {
                echo 'Waiting for the service to be ready...'
                // Add any necessary checks or delays to ensure the service is up
            }
        }

        stage('Run Tests') {
            steps {
                echo 'Running tests...'
                // Add your test steps here
            }
        }
    }

    post {
        always {
            echo 'Cleaning up the workspace...'
            cleanWs()
        }
        failure {
            echo 'Deployment failed!'
        }
    }
}
