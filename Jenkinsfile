pipeline {
    agent any

    environment {
        REPORT_DIR = "security-reports"
        IMAGE_NAME = "greenbiller_app"
    }

    stages {
        stage('Prepare Workspace') {
            steps {
                sh "mkdir -p ${REPORT_DIR}"
            }
        }

        stage('SAST - Semgrep') {
            steps {
                sh """
                    semgrep --config auto . --json > ${REPORT_DIR}/semgrep-report.json || true
                """
                archiveArtifacts artifacts: "${REPORT_DIR}/semgrep-report.json", fingerprint: true
            }
        }

        stage('Dependency Scanning - Trivy (Filesystem)') {
            steps {
                sh """
                    trivy fs --exit-code 0 --severity HIGH,CRITICAL --format json -o ${REPORT_DIR}/trivy-fs-report.json . || true
                """
                archiveArtifacts artifacts: "${REPORT_DIR}/trivy-fs-report.json", fingerprint: true
            }
        }

        stage('Secret Scanning - Gitleaks') {
            steps {
                sh """
                    gitleaks detect --source . --report-path=${REPORT_DIR}/gitleaks-report.json --report-format=json || true
                """
                archiveArtifacts artifacts: "${REPORT_DIR}/gitleaks-report.json", fingerprint: true
            }
        }

        stage('IaC Scanning - Checkov') {
            when {
                anyOf {
                    expression { fileExists('terraform') }
                    expression { fileExists('kubernetes') }
                }
            }
            steps {
                sh """
                    checkov -d . -o json > ${REPORT_DIR}/checkov-report.json || true
                """
                archiveArtifacts artifacts: "${REPORT_DIR}/checkov-report.json", fingerprint: true
            }
        }

        stage('Evaluate Scan Results') {
            steps {
                script {
                    // Check if any of the reports indicate issues
                    def findingsExist = false
                    if (fileExists("${REPORT_DIR}/semgrep-report.json")) {
                        def semgrepReport = readFile("${REPORT_DIR}/semgrep-report.json")
                        if (semgrepReport.contains('"findings":6')) { findingsExist = true }
                    }
                    if (fileExists("${REPORT_DIR}/trivy-fs-report.json")) {
                        def trivyReport = readFile("${REPORT_DIR}/trivy-fs-report.json")
                        if (trivyReport.contains('"Vulnerabilities":')) { findingsExist = true }
                    }
                    if (fileExists("${REPORT_DIR}/gitleaks-report.json")) {
                        def gitleaksReport = readFile("${REPORT_DIR}/gitleaks-report.json")
                        if (gitleaksReport.contains('"leaks":')) { findingsExist = true }
                    }

                    if (findingsExist) {
                        currentBuild.result = 'UNSTABLE'
                        echo "⚠ Security issues detected! Build marked UNSTABLE."
                    } else {
                        echo "✅ No critical issues detected."
                    }
                }
            }
        }
    }

    post {
        always {
            emailext (
                to: "shilpigoyal7129@gmail.com",
                subject: "Jenkins Build Result: ${env.JOB_NAME} #${env.BUILD_NUMBER}",
                body: """
Hello,

The Jenkins build *${env.JOB_NAME}* (#${env.BUILD_NUMBER}) has completed with status: ${currentBuild.result}.

Reports are available here:
${env.BUILD_URL}artifact/${REPORT_DIR}/

Regards,
Jenkins DevSecOps Pipeline
"""
            )
        }
    }
}
