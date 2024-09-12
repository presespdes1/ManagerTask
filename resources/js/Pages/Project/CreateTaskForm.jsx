import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, useForm, Link } from "@inertiajs/react";
import InputError from "@/Components/InputError";
import InputLabel from "@/Components/InputLabel";
import PrimaryButton from "@/Components/PrimaryButton";
import TextInput from "@/Components/TextInput";
import Select from "@/Components/Select";

export default function CreateTaskForm({ className = "", project_id }) {
    const { data, setData, post, processing, errors, reset } = useForm({
        name: "",       
        project_id: project_id
    });   
    
    const submit = (e) => {
        e.preventDefault();

        post(route("task.store"), {
            onFinish: () => reset("name"),
        });
    };
    return (
        <div className={`form-container` + className}>
            <h2 className="form__title">Crea tu Tarea</h2>

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
                        onChange={(e) => setData("name", e.target.value)}
                        required
                    />

                    <InputError message={errors.name} className="mt-2" />
                </div>              
                <div className="flex form__buttons mt-4">
                    <PrimaryButton className="ms-4" disabled={processing}>
                        Crear
                    </PrimaryButton>
                    <Link
                        href={route("projects")}
                        className="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                    >
                        Cancelar
                    </Link>
                </div>
            </form>
        </div>
    );
}
