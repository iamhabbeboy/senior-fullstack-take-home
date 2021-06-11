from flask import Flask, request, json
from flask_cors import CORS
from lib.interview_soap_client import InterviewSoapClient

app = Flask(__name__)
CORS(app)


@app.route("/")
def index():
    return "Congratulations, lets get started!"


@app.route("/soap")
def soap():
    soap_client = InterviewSoapClient()
    res = soap_client.call(
        service='CompanyService',
        action='helloFromPHP',
    )

    return res

@app.route("/api/company/<company_id>")
def order(company_id):
    soap_client = InterviewSoapClient()
    res = soap_client.call(
        service='RequestService',
        action='index',
        args={'id': company_id}
    )

    return res

@app.route("/api/company/<company_id>/service", methods=["GET", "POST"])
def update_service(company_id):
    if request.method == "POST":
        staff_id = request.form['user_id']
        service_request_id = request.form['service_request_id']
        soap_client = InterviewSoapClient()
        res = soap_client.call(
            service='RequestService',
            action='setStaff',
            args={'id': company_id, 'staff_id': staff_id, 'service_request_id': service_request_id}
        )

        return res


@app.route('/webhook', methods=['POST'])
def webhook():
    if request.headers['Content-Type'] == 'application/json':
        response = request.json
        issue_title = response["issue"]["title"]
        issue_body = response["issue"]["body"]
        issue_id = response['issue']['number']
        soap_client = InterviewSoapClient()
        res = soap_client.call(
            service='RequestService',
            action='store',
            args={'title': issue_title, 'body': issue_body, 'issue_id': issue_id}
        )
        return res

if __name__ == '__main__':
    app.run(debug=True)