document.addEventListener("DOMContentLoaded", function () {
  const imagePreviewInput = document.getElementById("image_preview_input");
  const preview = document.getElementById("image_preview");
  const imagePreviewSubmit = document.getElementById("image_preview_submit");

  if (!(imagePreviewInput && preview)) return;

  imagePreviewInput.style.display = "none";
  imagePreviewSubmit.style.display = "block";

  preview.addEventListener("click", function () {
    imagePreviewInput.click();
  });

  imagePreviewInput.addEventListener("change", function (event) {
    const file = event.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function (e) {
        document.getElementById("image_preview").src = e.target.result;
        imagePreviewSubmit.style.display = "block";
      };
      reader.readAsDataURL(file);
    }
  });
});

const ajax = {
    get: (url, params = {}) => fetch(`${url}?${new URLSearchParams(params)}`, {
        headers: { 'Accept': 'application/json' }
    }).then(response => response.json())
};

const debounce = (func, wait) => {
    let timeout;
    return (...args) => {
        clearTimeout(timeout);
        timeout = setTimeout(() => func(...args), wait);
    };
};

const generateAppointmentRow = appointment => `
    <tr>
        <td><a href="/tattooists/appointments/${appointment.id}">#${appointment.id}</a></td>
        <td>${appointment.date}</td>
        <td>${appointment.user.name}</td>
        <td>${appointment.location}</td>
        <td>${appointment.size}</td>
        <td>${appointment.status}</td>
        <td>
            <div class="d-flex flex-row-reverse">
                <form action="/tattooists/appointments/${appointment.id}" method="POST" class="m-0">
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-link"><i class="bi bi-archive"></i></button>
                </form>
                <a href="/tattooists/appointments/${appointment.id}/edit" class="btn btn-link pe-0">
                    <i class="bi bi-pencil-square"></i>
                </a>
            </div>
        </td>
    </tr>
`;

const updateAppointmentsTable = appointments => {
    const tbody = document.querySelector('#appointments-table tbody');
    tbody.innerHTML = appointments.length 
        ? appointments.map(generateAppointmentRow).join('')
        : '<tr><td colspan="7" class="text-center">Nenhum agendamento encontrado</td></tr>';
};

document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('search-client');
    if (!searchInput) return;

    searchInput.addEventListener('input', debounce(e => 
        ajax.get('/tattooists/appointments', { search: e.target.value.trim() })
            .then(data => updateAppointmentsTable(data.appointments))
            .catch(error => console.error('Erro na pesquisa:', error))
    , 300));
});
