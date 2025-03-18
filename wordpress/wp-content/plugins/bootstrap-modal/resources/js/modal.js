const modal = document.getElementById('bootstrap-modal');
let prev_id;

if (modal) {

  modal.addEventListener('show.bs.modal', event => {
    const button = event.relatedTarget;
    const id = button.getAttribute('data-bs-id');
    const size = button.getAttribute('data-bs-size');
    const modalDialog = modal.querySelector('.modal-dialog');
    const modalBody = modal.querySelector('.modal-body');

    if (size) {
      modalDialog.classList.add(size);
    }

    if (id !== prev_id) {
      modalBody.innerHTML = `
        <div class="d-flex justify-content-center opacity-25 py-5">
          <div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
          </div>
        </div>
      `;

      let queryParams = {
        'include': [id],
        '_embed': true,
      };

      fetch('/wp-json/wp/v2/modal?' + new URLSearchParams(queryParams))
        .then(response => {
          if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
          }
          return response.json();
        })
        .then(response => {
          if (!response[0]) {
            throw new Error(`WP error! Modal Not Found`);
          }

          modalBody.innerHTML = '';
          const fragment = document.createRange().createContextualFragment(response[0].content.rendered);
          modalBody.append(fragment);

          let callerData = {};
          for (let attr of button.attributes) {
            if (attr.name.startsWith('data-bs-caller-')) {
              let suffix = attr.name.replace('data-bs-caller-', '');
              callerData[suffix] = attr.value;
            }
          }

          if (Object.keys(callerData).length > 0) {
            let newHTML = modalBody.innerHTML;
            for (let suffix in callerData) {
              let placeholder = `[dynamic-bs-${suffix}]`;
              let value = callerData[suffix];
              newHTML = newHTML.split(placeholder).join(value);
            }
            modalBody.innerHTML = newHTML;
          }

          prev_id = id;
        })
        .catch(error => {
          console.error('Error loading data:', error);
          modalBody.innerHTML = error;
        });
    }
  });
}
