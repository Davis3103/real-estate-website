pipeline {
    agent any
    stages {
        stage('Build') {
            steps {
                script {
                    dockerCompose.build()
                }
            }
        }
        stage('Test') {
            steps {
                script {
                    dockerCompose.up('--abort-on-container-exit')
                }
            }
        }
        stage('Deploy') {
            steps {
                script {
                    dockerCompose.up('-d')
                }
            }
        }
    }
}
