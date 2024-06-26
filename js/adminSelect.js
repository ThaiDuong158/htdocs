
const inputs = document.querySelectorAll('.input--type');
const rows = document.querySelectorAll(".div--table tbody tr");
const headers = Array.from(document.querySelectorAll('thead tr th')).map(th => th.innerText.trim());
const labels = Array.from(document.querySelectorAll('label')).map(label => label.innerText.trim());

rows.forEach(row => {
    row.onclick = () => {
        row.querySelectorAll('td').forEach((td, i) => {
            const headerText = headers[i];
            const labelText = headerText + ":";

            const labelIndex = labels.findIndex(label => label === labelText);
            if (labelIndex !== -1) {
                const inputElement = inputs[labelIndex];
                if (inputElement.classList.contains('input--select')) {
                    const optionText = td.innerText.trim();
                    inputElement.querySelectorAll('option').forEach(option => {
                        if (option.text.trim() === optionText) {
                            option.selected = true;
                        }
                    });
                } else {
                    inputElement.value = td.innerText.trim();
                }
            }
        });
    };
});
