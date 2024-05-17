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
                bat 'docker stop php-web || echo "Container not running"'
                bat 'docker rm php-web || echo "Container not existing"'
                echo 'Starting new container...'
                bat 'docker run -d --name php-web -p 84:80 php-web'
            }
        }
        stage('Wait for Services') {
            steps {
                echo 'Waiting for services to start...'
                // Add a delay if necessary
                sleep(time: 30, unit: 'SECONDS')
            }
        }
        stage('Run Tests') {
            steps {
                echo 'Running tests...'
                // Add commands to run your tests here
            }
        }
    }
    
    post {
        always {
            echo 'Cleaning up the workspace...'
            cleanWs()
            echo 'Deployment failed!'
        }
    }
}
