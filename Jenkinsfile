pipeline {
    agent any
    environment {
        REPORT_DIR = "security-reports"
    }
    options {
        buildDiscarder(logRotator(daysToKeepStr: '7'))
        timestamps()
    }
    stages {

        stage('Prepare Workspace') {
            steps {
                sh 'mkdir -p ${REPORT_DIR}'
            }
        }

        stage('SAST - Semgrep') {
            steps {
                sh '''
                semgrep --config auto . --json > ${REPORT_DIR}/semgrep-report.json || true
                '''
            }
            post {
                always {
                    archiveArtifacts artifacts: '${REPORT_DIR}/semgrep-report.json', allowEmptyArchive: true
                }
                failure {
                    echo "Semgrep stage failed"
                }
            }
        }

        stage('Dependency Scanning - Trivy') {
            steps {
                sh '''
                trivy fs --exit-code 0 --severity HIGH,CRITICAL --format json -o ${REPORT_DIR}/trivy-fs-report.json .
                COUNT=$(jq '.Results[].Vulnerabilities | length' ${REPORT_DIR}/trivy-fs-report.json | awk '{s+=$1} END {print s}')
                echo "Trivy vulnerabilities found: $COUNT"
                if [ "$COUNT" -gt 0 ]; then
                  echo "Failing build due to HIGH/CRITICAL vulnerabilities"
                  exit 1
                fi
                '''
            }
            post {
                always {
                    archiveArtifacts artifacts: '${REPORT_DIR}/trivy-fs-report.json', allowEmptyArchive: true
                }
            }
        }

        stage('Secret Scanning - Gitleaks') {
            steps {
                sh '''
                gitleaks detect --source . --report-path=${REPORT_DIR}/gitleaks-report.json --report-format=json || true
                COUNT=$(jq length ${REPORT_DIR}/gitleaks-report.json)
                echo "Secrets found: $COUNT"
                if [ "$COUNT" -gt 0 ]; then
                  echo "Failing build due to exposed secrets"
                  exit 1
                fi
                '''
            }
            post {
                always {
                    archiveArtifacts artifacts: '${REPORT_DIR}/gitleaks-report.json', allowEmptyArchive: true
                }
            }
        }

        stage('Container & IaC Scanning') {
            parallel {
                stage('Trivy Image Scan') {
                    when {
                        expression { fileExists('Dockerfile') }
                    }
                    steps {
                        script {
                            def imageName = "app:${env.BUILD_ID}"
                            sh "docker build -t ${imageName} ."
                            sh "trivy image --exit-code 0 --severity HIGH,CRITICAL --format json -o ${REPORT_DIR}/trivy-image-report.json ${imageName} || true"
                            sh '''
                            COUNT=$(jq '.Results[].Vulnerabilities | length' ${REPORT_DIR}/trivy-image-report.json | awk '{s+=$1} END {print s}')
                            echo "Image vulnerabilities: $COUNT"
                            if [ "$COUNT" -gt 0 ]; then
                              echo "Failing build due to HIGH/CRITICAL container vulnerabilities"
                              exit 1
                            fi
                            '''
                        }
                    }
                    post {
                        always {
                            archiveArtifacts artifacts: '${REPORT_DIR}/trivy-image-report.json', allowEmptyArchive: true
                        }
                    }
                }

                stage('Checkov IaC Scan') {
                    when {
                        expression { fileExists('main.tf') || fileExists('deployment.yaml') }
                    }
                    steps {
                        sh '''
                        checkov -d . -o json > ${REPORT_DIR}/checkov-report.json || true
                        COUNT=$(jq length ${REPORT_DIR}/checkov-report.json)
                        echo "IaC issues: $COUNT"
                        if [ "$COUNT" -gt 0 ]; then
                          echo "Failing build due to IaC misconfigurations"
                          exit 1
                        fi
                        '''
                    }
                    post {
                        always {
                            archiveArtifacts artifacts: '${REPORT_DIR}/checkov-report.json', allowEmptyArchive: true
                        }
                    }
                }
            }
        }

        stage('Reporting') {
            steps {
                echo "Reports generated in ${REPORT_DIR}, archived as build artifacts"
            }
        }
    }
    post {
        always {
            echo "Pipeline finished. Reports are archived."
        }
    }
}
