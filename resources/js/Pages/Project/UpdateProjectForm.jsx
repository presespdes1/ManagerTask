import { useForm, Link, Head } from '@inertiajs/react';
import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import Checkbox from '@/Components/Checkbox';

export default function UpdateProjectForm({className = "", project}){
    const { data, setData, put, processing, errors, reset } = useForm({
        name: project.name,
        description: project.description,
        archived: project.isArchived           
    });

    const submit = (e) => {
        e.preventDefault();

        put(route('projects.update', [project.id]), {
            onFinish: () => reset('name', 'description', 'archived'),
        });       
    };
    return(
        <div className={`form-container ` + className}>
             {/* Update Project */}
             <h2 className='form__title'>Proyecto: {project.name}</h2>
             <form onSubmit={submit}>
                <div>
                    <InputLabel htmlFor="name" value="Nombre" />

                    <TextInput
                        id="name"
                        name="name"
                        value={data.name}
                        className="mt-1 block w-full"
                        autoComplete="name"
                        isFocused={true}
                        onChange={(e) => setData('name', e.target.value)}
                        required
                    />

                    <InputError message={errors.name} className="mt-2" />
                </div>
                <div>
                    <InputLabel htmlFor="description" value="Descripción" />

                    <TextInput
                        id="description"
                        name="description"
                        value={data.description}
                        className="mt-1 block w-full"
                        autoComplete="name"
                        isFocused={true}
                        onChange={(e) => setData('description', e.target.value)}                       
                    />

                    <InputError message={errors.description} className="mt-2" />
                </div>               
                <div className="block mt-4">
                    <label className="flex items-center">
                        <Checkbox
                            name="archived"
                            checked={data.archived}
                            onChange={(e) => setData('archived', e.target.checked)}
                        />
                        <span className="ms-2 text-sm text-gray-600 dark:text-gray-400">Archivar</span>
                    </label>
                </div>
                <div className="form__buttons flex mt-4">                   
                    <PrimaryButton className="ms-4" disabled={processing}>
                        Actualizar
                    </PrimaryButton>
                    <Link
                        href={route("projects")}
                        className="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                    >Cancelar</Link>
                </div>
            </form>
        </div>
    );
};