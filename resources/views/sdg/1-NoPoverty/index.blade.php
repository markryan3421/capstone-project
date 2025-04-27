<x-layout>
    <div class="bg-gray-800 p-6 rounded-2xl shadow">
      <h1 class="text-2xl font-bold text-white">SDG #1: No Poverty</h1>
    </div>

    <div class="bg-gray-800 p-6 rounded-2xl shadow overflow-x-auto">
        <h2 class="text-lg font-semibold mb-4 text-white">Table Name</h2>
        <table class="min-w-full text-sm text-left border border-gray-700">
          <thead class="bg-gray-700 text-white">
            <tr>
              <th class="px-4 py-2 border border-gray-600">Col 1</th>
              <th class="px-4 py-2 border border-gray-600">Col 2</th>
              <th class="px-4 py-2 border border-gray-600">Col 3</th>
              <th class="px-4 py-2 border border-gray-600">Col 4</th>
            </tr>
          </thead>
          <tbody>
            <tr class="hover:bg-gray-700 text-white">
              <td class="px-4 py-2 border border-gray-600">Row 1</td>
              <td class="px-4 py-2 border border-gray-600">Data</td>
              <td class="px-4 py-2 border border-gray-600">Data</td>
              <td class="px-4 py-2 border border-gray-600">Data</td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-gray-800 rounded-2xl shadow p-6 flex justify-between items-center">
          <div>
            <div class="text-3xl font-bold text-white">00</div>
            <div class="text-sm text-gray-400">Total Short Term Goals</div>
          </div>
          <button class="bg-blue-500 text-white px-4 py-2 rounded-xl text-sm">CTA</button>
        </div>
        <div class="bg-gray-800 rounded-2xl shadow p-6 flex justify-between items-center">
          <div>
            <div class="text-3xl font-bold text-white">00</div>
            <div class="text-sm text-gray-400">Total Long Term Goals</div>
          </div>
          <button class="bg-blue-500 text-white px-4 py-2 rounded-xl text-sm">CTA</button>
        </div>
      </div>
</x-layout>