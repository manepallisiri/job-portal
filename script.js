// REGISTER
function register() {
let name = document.getElementById("name").value;
let email = document.getElementById("email").value;
let password = document.getElementById("password").value;

let user = { name, email, password };

localStorage.setItem(email, JSON.stringify(user));

alert("Registered Successfully");
window.location.href = "login.html";
}

// LOGIN
function login() {
let email = document.getElementById("loginEmail").value;
let password = document.getElementById("loginPassword").value;

let user = JSON.parse(localStorage.getItem(email));

if (user && user.password === password) {
localStorage.setItem("currentUser", email);
window.location.href = "dashboard.html";
} else {
alert("Invalid Credentials");
}
}

// LOAD USER
if (window.location.pathname.includes("dashboard.html")) {
let email = localStorage.getItem("currentUser");
let user = JSON.parse(localStorage.getItem(email));

if (user) {
document.getElementById("userName").innerText = user.name;
}
}

// LOGOUT
function logout() {
localStorage.removeItem("currentUser");
window.location.href = "login.html";
}

// POSTS (LinkedIn-like)
function addPost() {
let content = document.getElementById("postContent").value;

let posts = JSON.parse(localStorage.getItem("posts")) || [];
posts.push(content);

localStorage.setItem("posts", JSON.stringify(posts));

displayPosts();
}

// DISPLAY POSTS
function displayPosts() {
let posts = JSON.parse(localStorage.getItem("posts")) || [];
let feed = document.getElementById("feed");

feed.innerHTML = "";

posts.forEach(post => {
let div = document.createElement("div");
div.innerHTML = `<p>${post}</p>`;
feed.appendChild(div);
});
}

// LOAD POSTS
if (window.location.pathname.includes("dashboard.html")) {
displayPosts();
}