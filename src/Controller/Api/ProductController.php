<?php
namespace App\Controller\Api;

use App\Entity\Product;
use App\Exception\CustomProductPriceTypeException;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\Exception\NotNormalizableValueException;

/**
 * @Route("/api/products")
 */
class ProductController extends AbstractController
{
    private ProductRepository $productRepository;
    private EntityManagerInterface $entityManager;

    public function __construct(ProductRepository $productRepository, EntityManagerInterface $entityManager)
    {
        $this->productRepository = $productRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("", methods={"GET"})
     */
    public function index(): Response
    {
        $products = $this->productRepository->findAll();
        return $this->json([
            'status_code' => Response::HTTP_OK,
            'message' => 'All products fetched successfully.',
            'data' => $products
        ], Response::HTTP_OK);
    }

    /**
     * @Route("/{id}", methods={"GET"})
     */
    public function show(int $id): Response
    {
        $product = $this->productRepository->find($id);
        if (!$product) {
            return $this->json([
                'status_code' => Response::HTTP_NOT_FOUND,
                'message' => 'Product not found.'
            ], Response::HTTP_NOT_FOUND);
        }
        return $this->json([
            'status_code' => Response::HTTP_OK,
            'message' => 'Product detail fetched successfully.',
            'data' => $product
        ], Response::HTTP_OK);
    }

    /**
     * @Route("", methods={"POST"})
     * @IsGranted("ROLE_USER")
     */
    public function create(Request $request, SerializerInterface $serializer, ValidatorInterface $validator): Response
    { 
        try{
            $product = $serializer->deserialize($request->getContent(), Product::class, 'json');
            $errors = $validator->validate($product);
            if (COUNT($errors) > 0) {
                return $this->json([
                    'status_code' => Response::HTTP_BAD_REQUEST,
                    'message' => $errors
                ], Response::HTTP_BAD_REQUEST);
            }

            $this->entityManager->persist($product);
            $this->entityManager->flush();
            return $this->json([
                'status_code' => Response::HTTP_CREATED,
                'message' => 'Product created successfully.',
                'data' => $product
            ], Response::HTTP_CREATED);
        }catch (NotNormalizableValueException $e) {
            return $this->json([
                'status_code' => Response::HTTP_BAD_REQUEST,
                'message' => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }catch(ProductPriceTypeException $e){
            return $this->json([
                'status_code' => Response::HTTP_BAD_REQUEST,
                'message' => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @Route("/{id}", methods={"PUT"})
     * @IsGranted("ROLE_USER")
     */
    public function update(int $id, Request $request, SerializerInterface $serializer, ValidatorInterface $validator): Response
    {
        $product = $this->productRepository->find($id);
        if (!$product) {
            return $this->json([
                'status_code' => Response::HTTP_NOT_FOUND,
                'message' => 'Product not found.'
            ], Response::HTTP_NOT_FOUND);
        }
        $serializer->deserialize($request->getContent(), Product::class, 'json', ['object_to_populate' => $product]);
        $errors = $validator->validate($product);
        if (count($errors) > 0) {
            return $this->json([
                'status_code' => Response::HTTP_BAD_REQUEST,
                'message' => $errors
            ], Response::HTTP_BAD_REQUEST);
        }
        $this->entityManager->flush();
        return $this->json([
            'status_code' => Response::HTTP_OK,
            'message' => 'Product updated successfully.',
            'data' => $product
        ], Response::HTTP_OK);
    }

    /**
     * @Route("/{id}", methods={"DELETE"})
     * @IsGranted("ROLE_USER")
     */
    public function delete(int $id): Response
    {
        $product = $this->productRepository->find($id);
        if (!$product) {
            return $this->json([
                'status_code' => Response::HTTP_NOT_FOUND,
                'message' => 'Product not found.'
            ], Response::HTTP_NOT_FOUND);
        }
        
        $this->entityManager->remove($product);
        $this->entityManager->flush();
        return $this->json([
            'status_code' => Response::HTTP_OK,
            'message' => 'Product deleted successfully.'
        ], Response::HTTP_OK);
    }
}

