pipeline {
    agent any

    parameters {
        string(name: 'BRANCH_NAME', defaultValue: 'main', description: 'Branch to build')
    }

    environment {
        // Define environment variables for database credentials
        MYSQL_ROOT_PASSWORD = 'your_password'
        MYSQL_DATABASE = 'real_estate'
        MYSQL_USER = 'root'
        MYSQL_PASSWORD = 'your_password'
    }

    stages {
        stage('Checkout') {
            steps {
                // Checkout the branch specified in parameters
                git branch: "${params.BRANCH_NAME}", url: 'https://github.com/Davis3103/real-estate-website.git'
            }
        }

        stage('Build Docker Images') {
            steps {
                // Build the Docker image for the PHP application
                script {
                    echo "Building Docker image for PHP application..."
                    docker.build('php-web', '-f Dockerfile .')
                }
            }
        }

        stage('Deploy Containers') {
            steps {
                script {
                    echo "Stopping any existing containers..."
                    sh 'docker-compose down'  // Stop any existing containers
                    echo "Starting the Docker containers..."
                    sh 'docker-compose up -d' // Start the containers in detached mode
                }
            }
        }

        stage('Wait for Services') {
            steps {
                // Wait for the MySQL service to be fully up and running
                script {
                    echo "Waiting for MySQL service to be fully up and running..."
                    waitUntil {
                        try {
                            sh 'docker exec mysql-container mysqladmin ping -h"localhost" --silent'
                            return true
                        } catch (Exception e) {
                            echo "MySQL service is not up yet. Retrying..."
                            return false
                        }
                    }
                }
            }
        }

        stage('Run Tests') {
            steps {
                // Add steps to run your tests here (e.g., using PHPUnit or any other testing framework)
                echo 'Running tests...'
                // sh 'vendor/bin/phpunit'  // Uncomment and adjust this line according to your testing setup
            }
        }
    }

    post {
        always {
            // Clean up the workspace
            echo "Cleaning up the workspace..."
            cleanWs()
        }
        success {
            echo 'Deployment succeeded!'
        }
        failure {
            echo 'Deployment failed!'
        }
    }
}
