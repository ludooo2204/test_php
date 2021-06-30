let reponseLog = "rien à loggué";
let divLog = document.getElementById('debug');
console.log(divLog)
const traitementReponse = (e) => {
	console.log(e);
	reponseLog = e;
	divLog.innerHTML = reponseLog;
};
const id = "";
const test = () => {
	axios.get(`/test_php/api/test_php/${id}`).then((e) => {
		console.log(e.data);
		reponseLog = JSON.stringify(e.data);
		divLog.innerHTML = reponseLog;
	});
	// ajaxGet(`/test_php/api/test_php/${id}`, traitementReponse);
};

const newPersonne = {
	first_name: "oliver2",
	last_name: "jouet",
	email: "test@trescal.com",
	company: "trescal",
	createdAt: "2021-04-11",
	//  "modifiedAt": "2021-05-17"
};
// url, data, callback, isJson
const testPost = () => {
	ajaxPost(`/test_php/api/test_php`, newPersonne, traitementReponse, true);
	// ajaxPost(`/test_php/api/testpost.php`,newPersonne, traitementReponse,true);
};
const testPostPdo = () => {
	ajaxPost(`/test_php/api/pdo_post.php`, newPersonne, traitementReponse, true);
	// ajaxPost(`/test_php/api/testpost.php`,newPersonne, traitementReponse,true);
};
const testGetPdo = () => {
	axios.get(`/test_php/api/pdo_get.php`).then((e) => {
		console.log(e.data);
		reponseLog = JSON.stringify(e.data);
		divLog.innerHTML = reponseLog;
	});
	// ajaxPost(`/test_php/api/testpost.php`,newPersonne, traitementReponse,true);
};
const testGetPdoAvecParametre = () => {
	let value = document.getElementById("tete").value;

	axios.post(`/test_php/api/pdo_get.php`, value).then((e) => {
		console.log(e.data);
		reponseLog = JSON.stringify(e.data);
		divLog.innerHTML = reponseLog;
	});
	// ajaxPost(`/test_php/api/testpost.php`,newPersonne, traitementReponse,true);
};
