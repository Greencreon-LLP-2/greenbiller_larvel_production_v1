pipeline {
    agent any
    environment {
        REPORT_DIR = "security-reports"
    }
    stages {
        stage('Prepare Workspace') {
            steps {
                sh "mkdir -p ${REPORT_DIR}"
            }
        }
        stage('SAST - Semgrep') {
            steps {
                sh "semgrep --config auto . --json > ${REPORT_DIR}/semgrep-report.json"
                archiveArtifacts artifacts: "${REPORT_DIR}/semgrep-report.json", fingerprint: true
            }
        }
        stage('Dependency Scanning - Trivy') {
            steps {
                sh "trivy fs --exit-code 0 --severity HIGH,CRITICAL --format json -o ${REPORT_DIR}/trivy-fs-report.json ."
                archiveArtifacts artifacts: "${REPORT_DIR}/trivy-fs-report.json", fingerprint: true
            }
        }
        stage('Secret Scanning - Gitleaks') {
            steps {
                sh "gitleaks detect --source . --report-path=${REPORT_DIR}/gitleaks-report.json --report-format=json"
                archiveArtifacts artifacts: "${REPORT_DIR}/gitleaks-report.json", fingerprint: true
            }
        }
        // Add Container & IaC Scanning + Reporting...
    }
}
