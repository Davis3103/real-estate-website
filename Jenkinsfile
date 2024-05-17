pipeline {
    agent any

    stages {
        stage('checkout') {
            steps {
                checkout scm
            }
        }
        
    
        stage('Deploy Mysql Container') {
    steps {
        script {
            // Change directory to where docker-compose.yml is located
            dir("${env.WORKSPACE}\\my_nextjs_app") {
                // Run docker-compose up to deploy Mysql container
                bat 'docker-compose up -d'
            }
        }
    }
}
    }
}
