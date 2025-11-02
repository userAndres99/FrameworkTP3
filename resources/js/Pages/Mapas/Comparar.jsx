import React from 'react';
import MapaInteractivoREST from '@/Components/MapaInteractivoREST';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';

export default function CompararMapas() {
  return (
    <AuthenticatedLayout
      header={<h2 className="text-xl font-semibold leading-tight text-gray-800">Mapa REST</h2>}
    >
      <Head title="Mapa REST" />

      <div className="py-6">
        <div className="mx-auto max-w-3xl sm:px-6 lg:px-8">
          <div className="bg-white shadow-sm sm:rounded-lg p-6">
            <h1 className="text-2xl font-semibold mb-4">Mapa (REST)</h1>
            <p className="text-sm text-gray-600 mb-4">Este mapa consume el endpoint REST wrapper: <code>/soap/organizaciones/rest</code></p>
            <MapaInteractivoREST />
          </div>
        </div>
      </div>
    </AuthenticatedLayout>
  );
}