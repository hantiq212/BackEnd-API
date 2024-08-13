// script.js

const apiUrl = 'http://localhost:8000/api'; // Ubah sesuai URL API kamu

document.addEventListener('DOMContentLoaded', () => {
    if (window.location.pathname === '/login') {
        document.querySelector('#login-form').addEventListener('submit', handleLogin);
    } else if (window.location.pathname === '/dashboard') {
        fetchDivisions();
        fetchEmployees();
        document.querySelector('#employee-form').addEventListener('submit', handleEmployeeSubmit);
        document.querySelector('#search-button').addEventListener('click', fetchEmployees);
    }
});

async function fetchEmployees() {
    const token = localStorage.getItem('token');
    if (!token) {
        window.location.href = 'login';
        return;
    }

    const name = document.querySelector('#search-name').value;
    const divisionId = document.querySelector('#filter-division').value;

    let url = `${apiUrl}/employees?`;
    if (name) url += `name=${encodeURIComponent(name)}&`;
    if (divisionId) url += `division_id=${encodeURIComponent(divisionId)}`;

    try {
        const response = await fetch(url, {
            headers: { 'Authorization': `Bearer ${token}` }
        });

        const data = await response.json();
        if (data.status === 'success') {
            renderEmployees(data.data.employees);
        } else {
            console.error('Error:', data.message);
        }
    } catch (error) {
        console.error('Error:', error);
    }
}

async function fetchDivisions() {
    const token = localStorage.getItem('token');
    if (!token) {
        window.location.href = 'login';
        return;
    }

    try {
        const response = await fetch(`${apiUrl}/divisions`, {
            headers: { 'Authorization': `Bearer ${token}` }
        });

        const data = await response.json();
        if (data.status === 'success') {
            const select = document.querySelector('#filter-division');
            data.data.divisions.forEach(division => {
                const option = document.createElement('option');
                option.value = division.id;
                option.textContent = division.name;
                select.appendChild(option);
            });
        } else {
            console.error('Error:', data.message);
        }
    } catch (error) {
        console.error('Error:', error);
    }
}
