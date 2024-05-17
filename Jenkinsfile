pipeline {
    agent any

    stages {
        stage('Build') {
            steps {
                sh 'docker-compose build'
            }
        }

        stage('Run') {
            steps {
                sh 'docker-compose up -d'
            }
        }

        stage('Test') {
            steps {
                sh 'docker-compose exec php-app php /var/www/html/test.php'
            }
        }

        stage('Stop') {
            steps {
                sh 'docker-compose down'
            }
        }
    }
}
