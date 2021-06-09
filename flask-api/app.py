from flask import Flask, request, json
from flask_cors import CORS
from lib.interview_soap_client import InterviewSoapClient

app = Flask(__name__)
# app.config['APPLICATION_ROOT'] = "/api/"
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

@app.route("/auth", methods=["POST"])
def auth():
    soap_client = InterviewSoapClient()
    res = soap_client.call(
        service='AuthService',
        action='login',
        args={'email': request.form.get('email'), 'password': request.form.get('password')}
    )

    return res

#/api/companies/1/services/1/rate
#/api/companies?service_type=residential
#/api/companies/1/workorders?state=finished

@app.route("/api/company/<company_id>")
def order(company_id):
    soap_client = InterviewSoapClient()
    res = soap_client.call(
        service='RequestService',
        action='helloFromPHP',
        args={'id': company_id}
    )

    return res


@app.route("/testing/<company_id>")
def company(company_id):
    issue_title = 'Hello world';
    issue_body = "service_id=1\nservice_id=1\ncompany_id=1\nunit=sqft\ntotal=3000\ncheck_in=2021-05-16T19:20:30.45+01:00\ncheck_out=2021-05-16T19:20:30.45+01:00"
    soap_client = InterviewSoapClient()
    res = soap_client.call(
        service='RequestService',
            action='storeServices',
        args={'title': issue_title, 'body': issue_body}
    )

    return res

@app.route('/webhook', methods=['POST'])
def webhook():
    if request.headers['Content-Type'] == 'application/json':
        response = request.json
        issue_title = response["issue"]["title"]
        issue_body = response["issue"]["body"]
        soap_client = InterviewSoapClient()
        res = soap_client.call(
            service='RequestService',
            action='storeServices',
            args={'title': issue_title, 'body': issue_body}
        )
        return res