class FlySymfonyRuntime extends SymfonyRuntime
{
    public function __construct(array $options = [])
    {
        $options['disable_dotenv'] = true;

        parent::__construct($options);
    }
}
