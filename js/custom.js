const tbody = document.querySelector(".listar-usuarios");

const listUsers = async (page) => {
  const data = await fetch("./list.php?page=" + page);
  const response = await data.text();
  tbody.innerHTML = response;
};

listUsers(1);
