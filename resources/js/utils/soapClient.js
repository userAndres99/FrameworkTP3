export async function getOrganizacionesSOAP() {
  const url = '/soap/organizaciones';
  const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

  const soapBody = `
    <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
      <soapenv:Body>
        <getOrganizaciones xmlns="http://localhost/soap/organizaciones"/>
      </soapenv:Body>
    </soapenv:Envelope>
  `;

  try {
    const res = await fetch(url, {
      method: 'POST',
      headers: {
        'Content-Type': 'text/xml; charset=utf-8',
        'SOAPAction': 'getOrganizaciones',
        'X-CSRF-TOKEN': token,
      },
      body: soapBody,
    });

    const text = await res.text();
    const parser = new DOMParser();
    const xml = parser.parseFromString(text, 'text/xml');

    const items = Array.from(xml.getElementsByTagName('item'));
    const organizaciones = items.map(item => ({
      id: item.getElementsByTagName('id')[0].textContent,
      nombre: item.getElementsByTagName('nombre')[0].textContent,
      telefono: item.getElementsByTagName('telefono')[0].textContent,
      email: item.getElementsByTagName('email')[0].textContent,
      descripcion: item.getElementsByTagName('descripcion')[0].textContent,
      latitud: parseFloat(item.getElementsByTagName('latitud')[0].textContent),
      longitud: parseFloat(item.getElementsByTagName('longitud')[0].textContent),
    }));

    console.log('Organizaciones parseadas:', organizaciones);
    return organizaciones;

  } catch (err) {
    console.error('Error fetching SOAP organizaciones:', err);
    return [];
  }
}
