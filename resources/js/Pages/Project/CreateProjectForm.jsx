import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, useForm, Link } from "@inertiajs/react";
import InputError from "@/Components/InputError";
import InputLabel from "@/Components/InputLabel";
import PrimaryButton from "@/Components/PrimaryButton";
import TextInput from "@/Components/TextInput";

export default function CreateProjectForm({ auth, className = "" }) {
    const { data, setData, post, processing, errors, reset } = useForm({
        name: "",
        description: "",
    });

    const submit = (e) => {
        e.preventDefault();

        post(route("projects.store"), {
            onFinish: () => reset("name", "description"),
        });
    };
    return (
        <div className={`form-container` + className}>
            <h2 className="form__title">Crea tu Proyecto</h2>

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
                <div>
                    <InputLabel htmlFor="description" value="Descripción" />

                    <TextInput
                        id="description"
                        name="description"
                        value={data.description}
                        className="mt-1 block w-full"
                        autoComplete="description"
                        isFocused={true}
                        onChange={(e) => setData("description", e.target.value)}
                    />

                    <InputError message={errors.description} className="mt-2" />
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
