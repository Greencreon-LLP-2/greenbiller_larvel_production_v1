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
                    def issuesFound = false

                    // Semgrep
                    if (fileExists("${REPORT_DIR}/semgrep-report.json")) {
                        def semgrepReport = readJSON file: "${REPORT_DIR}/semgrep-report.json"
                        if (semgrepReport.results && semgrepReport.results.size() > 0) {
                            echo "Semgrep found issues"
                            issuesFound = true
                        }
                    }

                    // Trivy FS
                    if (fileExists("${REPORT_DIR}/trivy-fs-report.json")) {
                        def trivyFS = readJSON file: "${REPORT_DIR}/trivy-fs-report.json"
                        if (trivyFS.Results && trivyFS.Results.any { it.Vulnerabilities }) {
                            echo "Trivy FS found vulnerabilities"
                            issuesFound = true
                        }
                    }

                    // Gitleaks
                    if (fileExists("${REPORT_DIR}/gitleaks-report.json")) {
                        def gitleaks = readJSON file: "${REPORT_DIR}/gitleaks-report.json"
                        if (gitleaks.findAll { it != null }.size() > 0) {
                            echo "Gitleaks found secrets"
                            issuesFound = true
                        }
                    }

                    // Checkov
                    if (fileExists("${REPORT_DIR}/checkov-report.json")) {
                        def checkov = readJSON file: "${REPORT_DIR}/checkov-report.json"
                        if (checkov.summary && checkov.summary.failed_checks > 0) {
                            echo "Checkov found IaC misconfigurations"
                            issuesFound = true
                        }
                    }

                    if (issuesFound) {
                        currentBuild.result = "UNSTABLE"
                        echo "Security issues detected. Build marked as UNSTABLE."
                    } else {
                        echo "No major security issues detected."
                    }
                }
            }
        }
    }

    post {
        always {
            emailext(
                to: "shilpigoyal7129@gmail.com",
                subject: "DevSecOps Report - ${env.JOB_NAME} #${env.BUILD_NUMBER} - ${currentBuild.currentResult}",
                body: """
<h2>DevSecOps Pipeline Summary</h2>
<p><b>Project:</b> ${env.JOB_NAME}</p>
<p><b>Build Number:</b> #${env.BUILD_NUMBER}</p>
<p><b>Status:</b> ${currentBuild.currentResult}</p>
<p>Reports:</p>
<ul>
  <li><a href="${env.BUILD_URL}artifact/${REPORT_DIR}/semgrep-report.json">Semgrep Report</a></li>
  <li><a href="${env.BUILD_URL}artifact/${REPORT_DIR}/trivy-fs-report.json">Trivy FS Report</a></li>
  <li><a href="${env.BUILD_URL}artifact/${REPORT_DIR}/gitleaks-report.json">Gitleaks Report</a></li>
  <li><a href="${env.BUILD_URL}artifact/${REPORT_DIR}/checkov-report.json">Checkov Report</a></li>
</ul>
<p>If status is UNSTABLE, one or more scans found issues. Please review the reports.</p>
""",
                mimeType: 'text/html',
                attachmentsPattern: "${REPORT_DIR}/*.json"
            )
        }
    }
}
