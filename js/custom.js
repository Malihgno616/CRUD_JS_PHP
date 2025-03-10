const tbody = document.querySelector(".listar-usuarios");

const cadForm = document.getElementById("cad-usuario-form");

const msgAlertError = document.getElementById("msgAlertError");

const msgAlert = document.getElementById("msgAlert");

const cadModal = new bootstrap.Modal(
  document.getElementById("cadUsuarioModal")
);

const listUsers = async (page) => {
  const data = await fetch("./list.php?page=" + page);
  const response = await data.text();
  tbody.innerHTML = response;
};

listUsers(1);

cadForm.addEventListener("submit", async (e) => {
  e.preventDefault();
  // console.log("Cadastrado");

  const dataForm = new FormData(cadForm);

  dataForm.append("add", 1);
  // console.log(dataForm);

  document.getElementById("cad-usuario-btn").value = "Salvando...";

  const datas = await fetch("cadastrar.php", {
    method: "POST",
    body: dataForm,
  });

  const response = await datas.json();
  // console.log(response);

  if (response["erro"]) {
    msgAlertError.innerHTML = response["msg"];
  } else {
    msgAlert.innerHTML = response["msg"];
    cadForm.reset();
    cadModal.hide();

    listUsers(1);
  }

  document.getElementById("cad-usuario-btn").value = "Cadastrar";
});
