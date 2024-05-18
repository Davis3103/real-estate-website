pipeline {
    agent any
   
    stages {
        stage('Checkout') {
            steps {
                echo 'Checking out source code...'
                git branch: 'main', url: 'https://github.com/Davis3103/real-estate-website.git'
            }
        }
       
        stage('Build') {
            steps {
                echo 'Building Docker containers...'
                bat 'docker-compose -f "C://Users//Aakash//Desktop//travel//docker-compose.yml" up -d --build'
            }
        }

        stage('Deploy') {
            steps {    
                echo 'Deploying Docker containers...'
                script {
                    try {
                        bat 'docker-compose up'
                    }
                    catch (Exception e) {
                        echo "Deployment failed, but the pipeline continues."
                    }
                }
            }
        }
    }
   
    post {
        success {
            echo 'Pipeline completed successfully!'
        }
        failure {
            echo 'Pipeline failed!'
        }
    }
}
